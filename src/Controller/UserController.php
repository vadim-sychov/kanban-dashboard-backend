<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Module\EntityTransformer\UserArrayTransformer;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api/user", name="api_user")
 */
class UserController extends AbstractController
{
    private UserArrayTransformer $transformer;
    private EntityManagerInterface $entityManager;

    public function __construct(UserArrayTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="get_all", methods={"GET"})
     */
    public function getAll(UserRepository $repository): JsonResponse
    {
        $users = $repository->findAll();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArrayAll($users),
            'message' => 'success',
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['create']]);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->json([
                'status' => Response::HTTP_CREATED,
                'data' => $this->transformer->toArray($user),
                'message' => 'created',
            ]);
        }

        $errorMessage = $form->getErrors(true)->current()->getMessage();

        return $this->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'data' => $this->transformer->toArray($user),
            'message' => $errorMessage,
        ]);
    }

    /**
     * @Route("/{user}", name="get", methods={"GET"})
     */
    public function read(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            return $this->json([
                'status' => Response::HTTP_OK,
                'data' => $this->transformer->toArray($user),
                'message' => 'ok',
            ]);
        }

        $errorMessage = $form->getErrors(true)->current()->getMessage();

        return $this->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'data' => $this->transformer->toArray($user),
            'message' => $errorMessage,
        ]);
    }

    /**
     * @Route("/{userId}", name="edit", methods={"PUT"})
     */
    public function update(int $userId, Request $request): Response
    {
        /** @var User $user */
        $user = $this->entityManager->find(User::class, $userId);

        if (is_null($user)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['edit']]);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $this->entityManager->flush();

            return $this->json([
                'status' => Response::HTTP_OK,
                'data' => $this->transformer->toArray($user),
                'message' => 'ok',
            ]);
        }

        $errorMessage = $form->getErrors(true)->current()->getMessage();

        return $this->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'data' => $this->transformer->toArray($user),
            'message' => $errorMessage,
        ]);
    }

    /**
     * @Route("/{userId}", name="delete", methods={"DELETE"})
     */
    public function delete(int $userId): Response
    {
        /** @var User $user */
        $user = $this->entityManager->find(User::class, $userId);

        if (is_null($user)) {
            return $this->json([
                'status' => Response::HTTP_NOT_FOUND,
                'data' => [],
                'message' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => [],
            'message' => 'removed',
        ]);
    }

    /**
     * @Route("/info", name="get", methods={"GET"})
     */
    public function getUserInfo(UserInterface $user): Response
    {
        return $this->json([
            'status' => Response::HTTP_OK,
            'data' => $this->transformer->toArray($user),
            'message' => 'ok',
        ]);
    }
}
