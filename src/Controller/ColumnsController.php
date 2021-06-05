<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\TaskSwimlane;
use App\Module\EntityTransformer\ColumnArrayTransformer;
use App\Repository\TaskColumnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/swimlane/{swimlaneId}/column", name="api_swimlane_column")
 */
class ColumnsController extends AbstractController
{
    private ColumnArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(ColumnArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(TaskColumnRepository $repository, int $swimlaneId): JsonResponse
    {
        /** @var TaskSwimlane $taskSwimlane */
        $taskSwimlane = $this->entityManager->find(TaskSwimlane::class, $swimlaneId);

        if (is_null($taskSwimlane)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $columns = $repository->findBy(['swimlaneId' => $swimlaneId]);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($columns),
            'message' => 'success',
        ]);
    }
}
