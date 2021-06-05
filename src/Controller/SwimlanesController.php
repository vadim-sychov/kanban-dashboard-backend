<?php
declare(strict_types=1);

namespace App\Controller;

use App\Module\EntityTransformer\SwimlaneArrayTransformer;
use App\Repository\TaskSwimlaneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/swimlane", name="api_swimlane")
 */
class SwimlanesController extends AbstractController
{
    private SwimlaneArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(SwimlaneArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(TaskSwimlaneRepository $repository): JsonResponse
    {
        $swimlanes = $repository->findAll();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($swimlanes),
            'message' => 'success',
        ]);
    }
}
