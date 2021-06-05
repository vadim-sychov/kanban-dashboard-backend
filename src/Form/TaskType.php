<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Task;
use App\Entity\TaskColumn;
use App\Entity\TaskPriority;
use App\Entity\TaskSwimlane;
use App\Entity\User;
use App\Module\EventListener\TaskFormEventSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Title should not be blank']),
                ]
            ])
            ->add('text', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Text should not be blank']),
                ],
            ])
            ->add('priorityId', EntityType::class, [
                'class' => TaskPriority::class,
                'invalid_message' => 'Priority should not be blank',
            ])
            ->add('columnId', EntityType::class, [
                'class' => TaskColumn::class,
                'invalid_message' => 'Column should not be blank',
            ])
            ->add('swimlaneId', EntityType::class, [
                'class' => TaskSwimlane::class,
                'invalid_message' => 'Swimlane should not be blank',
            ])
            ->add('executorId', EntityType::class, [
                'class' => User::class,
                'invalid_message' => 'Executor should not be null',
            ]);

        $builder->addEventSubscriber(new TaskFormEventSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}
