<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Module\EntityTransformer\TaskArrayTransformer;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api/task", name="api_task")
 */
class TaskController extends AbstractController
{
    private TaskArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(TaskArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(TaskRepository $repository): JsonResponse
    {
        $tasks = $repository->findAll();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($tasks),
            'message' => 'success',
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request, UserInterface $user): Response
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $task->setOwnerId($user);

            $this->entityManager->persist($task);
            $this->entityManager->flush();

            return $this->json([
                'status' => Response::HTTP_CREATED,
                'data' => $this->transformer->toArray($task),
                'message' => 'created',
            ]);
        }

        $errorMessage = $form->getErrors(true)->current()->getMessage();

        return $this->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'data' => '',
            'message' => $errorMessage,
        ]);
    }

    /**
     * @Route("/{taskId}", name="get", methods={"GET"})
     */
    public function read(int $taskId): Response
    {
        /** @var Task $task */
        $task = $this->entityManager->find(Task::class, $taskId);

        if (is_null($task)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArray($task),
            'message' => '',
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/{taskId}", name="edit", methods={"PUT"})
     */
    public function update(int $taskId, Request $request): Response
    {
        /** @var Task $task */
        $task = $this->entityManager->find(Task::class, $taskId);

        if (is_null($task)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(TaskType::class, $task);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $this->entityManager->flush();

            return $this->json([
                'status' => Response::HTTP_OK,
                'data' => $this->transformer->toArray($task),
                'message' => 'ok',
            ]);
        }

        $errorMessage = $form->getErrors(true)->current()->getMessage();

        return $this->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'data' => $this->transformer->toArray($task),
            'message' => $errorMessage,
        ]);
    }

    /**
     * @Route("/{taskId}", name="delete", methods={"DELETE"})
     */
    public function delete(int $taskId): Response
    {
        /** @var Task $task */
        $task = $this->entityManager->find(Task::class, $taskId);

        if (is_null($task)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => [],
            'message' => 'removed',
        ]);
    }
}
