<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    /**
     * getAllUsers
     * @return jsonResponse Returns an array of Users Object
     */
    #[Route('/api/users', name: 'getAllUsers', methods: ['GET'])]
    public function getAllUsers(UserRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
      $users = $userRepository->findAll();
      if(count($users) === 0) {
        $message = [
          'statusCode' => 404,
          'message' => 'No data was found'
        ];
        return new JsonResponse($message, 404, ['accept' => 'json'], false);
      }
      $jsonUsers = $serializer->serialize($users, 'json', ['groups' => 'getUsers']);
      return new JsonResponse($jsonUsers, 200, ['accept' => 'json'], true);
    }

    /**
     * detailUser
     * @return jsonResponse Returns an array of One User Object
     */
    #[Route('/api/users/{id}', name: 'detailUser', methods: ['GET'])]
    public function getDetailUser(User $user, SerializerInterface $serializer): JsonResponse
    {
      $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);
      return new JsonResponse($jsonUser, 200, ['accept' => 'json'], true);
    }

    /**
     * deleteUser
     * @return jsonResponse Returns a message with the id of the deleted user
     */
    #[Route('/api/users/{id}', name: 'deleteUser', methods: ['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $em): JsonResponse
    {
      $userId = $user->getId();
      $em->remove($user);
      $em->flush();
      $message = [
        'statusCode' => 200,
        'message' => 'the user ' . $userId . ' has been deleted successfully.'
      ];
      return new JsonResponse($message, 200, ['accept' => 'json'], false);
    }

    /**
     * createUser
     * @return jsonResponse Returns an array of user objects created
     */
    #[Route('/api/users', name: 'createUser', methods: ['POST'])]
    public function createUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, AccountRepository $accountRepository): JsonResponse
    {
      $user = $serializer->deserialize($request->getContent(), User::class, 'json');

      $content = $request->toArray();

      $accountId = $content['accountId'];

      $user->setAccount($accountRepository->find($accountId));

      $date = new \DateTimeImmutable();
      $user->setCreatedAt($date);
      $user->setUpdatedAt($date);
      $em->persist($user);
      $em->flush();

      $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);

      return new JsonResponse($jsonUser, 200, ['accept' => 'json'], true);
    }

    /**
     * updateAccount
     * @return jsonResponse Returns an array of user objects updated
     */
    #[Route('/api/users/{id}', name: 'updateAccount', methods: ['PUT'])]
    public function updateAccount(Request $request, SerializerInterface $serializer, User $currentUser, EntityManagerInterface $em, AccountRepository $accountRepository): JsonResponse
    {
      $updatedUser = $serializer->deserialize(
        $request->getContent(),
        User::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUser]
      );

      $updatedUser->setUpdatedAt(new \DateTimeImmutable());

      $em->persist($updatedUser);
      $em->flush();

      $jsonUpdatedUser = $serializer->serialize($updatedUser, 'json', ['groups' => 'getUsers']);

      return new JsonResponse($jsonUpdatedUser, 200, ['accept' => 'json'], true);
    }
}
