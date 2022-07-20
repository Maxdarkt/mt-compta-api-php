<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
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
        return new JsonResponse($message, 404, [], false);
      }
      $jsonAccounts = $serializer->serialize($accounts, 'json', ['groups' => 'getAccounts']);
      return new JsonResponse($jsonAccounts, 200, [], true);
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
      return new JsonResponse($message, 200, [], false);
    }
}
