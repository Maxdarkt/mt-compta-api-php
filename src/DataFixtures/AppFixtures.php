<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Account;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    require_once("src/mock/mock_accounts.php");
    require_once("src/mock/mock_users.php");
    
    $jsonAccounts = json_decode(ACCOUNTS, true);
    $jsonUsers = json_decode(USERS, true);

    $listAccounts = [];
    // we create accounts
    foreach($jsonAccounts as $key => $value) {
      $account = new Account();
      $account->setCompany($value['company']);
      $account->setDivision($value['division']);
      $account->setComplement($value['complement']);
      $account->setaddress($value['address']);
      $account->setPostal($value['postal']);
      $account->setCity($value['city']);
      $account->setCountry($value['country']);
      $account->setCurrency($value['currency']);
      $account->setIsValidatedAccount($value['isValidatedAccount']);
      $account->setCreatedAt(new \DateTimeImmutable());
      $account->setUpdatedAt(new \DateTimeImmutable());
      $manager->persist($account);
      $listAccounts[] = $account;
    }

    foreach($jsonUsers as $key => $value) {
      $user = new User();
      $user->setLastName($value['lastName']);
      $user->setFirstName($value['firstName']);
      $user->setEmail($value['email']);
      $user->setPassword($value['password']);
      $user->setMobile($value['mobile']);
      $user->setFonction($value['fonction']);
      $user->setRole($value['role']);
      $user->setIsValidatedEmail($value['isValidatedEmail']);
      $user->setCreatedAt(new \DateTimeImmutable());
      $user->setUpdatedAt(new \DateTimeImmutable());
      $user->setAccount($listAccounts[$value['accountId'] - 1]);
      $manager->persist($user);
    }

    $manager->flush();
  }
}
