<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Entity\TaskComment;
use App\Form\CommentType;
use App\Module\EntityTransformer\CommentArrayTransformer;
use App\Repository\TaskCommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api/task/{taskId}/comment", name="api_task_comment")
 */
class TaskCommentController extends AbstractController
{
    private CommentArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(CommentArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(TaskCommentRepository $repository, int $taskId): JsonResponse
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

        $comments = $repository->findBy(['taskId' => $taskId]);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($comments),
            'message' => 'success',
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request, UserInterface $user, int $taskId): Response
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

        $comment = new TaskComment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $comment->setUserId($user);
            $comment->setTaskId($task);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->json([
                'status' => Response::HTTP_CREATED,
                'data' => $this->transformer->toArray($comment),
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
     * @Route("/{commentId}", name="delete", methods={"DELETE"})
     */
    public function delete(int $taskId, int $commentId): Response
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

        /** @var TaskComment $comment */
        $comment = $this->entityManager->find(TaskComment::class, $commentId);

        if (is_null($comment)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($comment);
        $this->entityManager->flush();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => [],
            'message' => 'removed',
        ]);
    }
}
