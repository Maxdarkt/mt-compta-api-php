<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/api/accounts', name: 'getAllAccounts', methods: ['GET'])]
    public function getAllAccounts(AccountRepository $accountRepository, SerializerInterface $serializer): JsonResponse
    {
      $accounts = $accountRepository->findAll();
      if(count($accounts) === 0) {
        $message = [
          'statusCode' => 404,
          'message' => 'No data was found'
        ];
        return new JsonResponse($message, 404, ['accept' => 'json'], false);
      }
      $jsonAccounts = $serializer->serialize($accounts, 'json', ['groups' => 'getAccounts']);
      return new JsonResponse($jsonAccounts, 200, ['accept' => 'json'], true);
    }

    #[Route('/api/accounts/{id}', name: 'getAccount', methods: ['GET'])]
    public function getAccount(Account $account, SerializerInterface $serializer): JsonResponse
    {
      $jsonAccount = $serializer->serialize($account, 'json', ['groups' => 'getAccounts']);
      return new JsonResponse($jsonAccount, 200, ['accept' => 'json'], true);
    }

    #[Route('/api/accounts/{id}', name: 'deleteAccount', methods: ['DELETE'])]
    public function deleteAccount(Account $account, EntityManagerInterface $em): JsonResponse
    {
      $accountId = $account->getId();
      $em->remove($account);
      $em->flush();
      $message = [
        'statusCode' => 200,
        'message' => 'the account ' . $accountId . ' has been deleted successfully.'
      ];
      return new JsonResponse($message, 200, ['accept' => 'json'], false);
    }

    #[Route('/api/accounts', name: 'createAccount', methods: ['POST'])]
    public function createAccount(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, AccountRepository $accountRepository): JsonResponse
    {
      $account = $serializer->deserialize($request->getContent(), Account::class, 'json');
      $date = new \DateTimeImmutable();
      $account->setCreatedAt($date);
      $account->setUpdatedAt($date);
      $em->persist($account);
      $em->flush();

      $jsonAccount = $serializer->serialize($account, 'json', ['groups' => 'getAccounts']);

      return new JsonResponse($jsonAccount, 200, ['accept' => 'json'], true);
    }

    #[Route('/api/accounts/{id}', name: 'updateAccount', methods: ['PUT'])]
    public function updateAccount(Request $request, SerializerInterface $serializer, Account $currentAccount, EntityManagerInterface $em, AccountRepository $accountRepository): JsonResponse
    {
      $updatedAccount = $serializer->deserialize(
        $request->getContent(),
        Account::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentAccount]
      );
      $updatedAccount->setUpdatedAt(new \DateTimeImmutable());
      $em->persist($updatedAccount);
      $em->flush();

      $jsonUpdatedAccount = $serializer->serialize($updatedAccount, 'json', ['groups' => 'getAccounts']);

      return new JsonResponse($jsonUpdatedAccount, 200, ['accept' => 'json'], true);
    }
}
