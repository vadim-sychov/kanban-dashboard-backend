<?php
declare(strict_types=1);

namespace App\Controller;

use App\Module\EntityTransformer\PriorityArrayTransformer;
use App\Repository\TaskPriorityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/priority", name="api_prorities")
 */
class PrioritiesController extends AbstractController
{
    private PriorityArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(PriorityArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(TaskPriorityRepository $repository): JsonResponse
    {
        $tasks = $repository->findAll();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($tasks),
            'message' => 'success',
        ]);
    }
}
