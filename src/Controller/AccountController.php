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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * getAllAccounts
     * @return jsonResponse Returns an array of Accounts Object
     */
    #[Route('/api/accounts', name: 'getAllAccounts', methods: ['GET'])]
    public function getAllAccounts(AccountRepository $accountRepository, SerializerInterface $serializer): JsonResponse
    {
      $accounts = $accountRepository->findAll();
      // if $account is empty
      if(count($accounts) === 0) {
        $message = [
          'statusCode' => 404,
          'message' => 'No data was found'
        ];
        return new JsonResponse($message, 404, ['accept' => 'json'], false);
      }
      // if $account is filled
      $jsonAccounts = $serializer->serialize($accounts, 'json', ['groups' => 'getAccounts']);
      return new JsonResponse($jsonAccounts, 200, ['accept' => 'json'], true);
    }

    /**
     * detailAccount
     * @return jsonResponse Returns an array of One account Object
     */
    #[Route('/api/accounts/{id}', name: 'detailAccount', methods: ['GET'])]
    public function getDetailAccount(Account $account, SerializerInterface $serializer): JsonResponse
    {
      $jsonAccount = $serializer->serialize($account, 'json', ['groups' => 'getAccounts']);
      return new JsonResponse($jsonAccount, 200, ['accept' => 'json'], true);
    }

    /**
     * deleteAccount
     * @return jsonResponse Returns a message with the id of the deleted account
     */
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

    /**
     * createAccount
     * @return jsonResponse Returns an array of account objects created
     */
    #[Route('/api/accounts', name: 'createAccount', methods: ['POST'])]
    public function createAccount(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, AccountRepository $accountRepository, ValidatorInterface $validator): JsonResponse
    {
      $account = $serializer->deserialize($request->getContent(), Account::class, 'json');
      
      $date = new \DateTimeImmutable();
      $account->setCreatedAt($date);
      $account->setUpdatedAt($date);

      // we check errors
      $errors = $validator->validate($account);
      if($errors->count() > 0) {
        return new jsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        // throw new HttpException(JsonResponse::HTTP_BAD_REQUEST, "the request is incorrrect")
      }

      $em->persist($account);
      $em->flush();

      $jsonAccount = $serializer->serialize($account, 'json', ['groups' => 'getAccounts']);

      return new JsonResponse($jsonAccount, 200, ['accept' => 'json'], true);
    }

    /**
     * updateAccount
     * @return jsonResponse Returns an array of account objects updated
     */
    #[Route('/api/accounts/{id}', name: 'updateAccount', methods: ['PUT'])]
    public function updateAccount(Request $request, SerializerInterface $serializer, Account $currentAccount, EntityManagerInterface $em, AccountRepository $accountRepository, ValidatorInterface $validator): JsonResponse
    {
      $updatedAccount = $serializer->deserialize(
        $request->getContent(),
        Account::class,
        'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $currentAccount]
      );
      
      $updatedAccount->setUpdatedAt(new \DateTimeImmutable());

      // we check errors
      $errors = $validator->validate($updatedAccount);
      if($errors->count() > 0) {
        return new jsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        // throw new HttpException(JsonResponse::HTTP_BAD_REQUEST, "the request is incorrrect")
      }

      $em->persist($updatedAccount);
      $em->flush();

      $jsonUpdatedAccount = $serializer->serialize($updatedAccount, 'json', ['groups' => 'getAccounts']);

      return new JsonResponse($jsonUpdatedAccount, 200, ['accept' => 'json'], true);
    }
}
