<?php
declare(strict_types=1);

namespace App\Module\EventListener;

use App\Entity\Task;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TaskFormEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return [FormEvents::PRE_SUBMIT => 'preSubmit'];
    }

    public function preSubmit(FormEvent $event): void
    {
        /** @var Task $task */
        $task = $event->getForm()->getData();
        $data = $event->getData();

        if (isset($data['priority']) || isset($data['column']) || isset($data['swimlane']) || isset($data['owner'])) {
            $data['priorityId'] = $data['priority']['id'];
            $data['columnId'] = $data['column']['id'];
            $data['swimlaneId'] = $data['swimlane']['id'];


            if (!is_null($task->getExecutorId())) {
                $data['executorId'] = $task->getExecutorId()->getId();
            } else {
                $data['executorId'] = $data['executor']['id'];
            }
        }

        $event->setData($data);
    }
}
