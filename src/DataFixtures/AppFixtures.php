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
      // we create 1 account
      $account = new Account();
      $account->setCompany('Test');
      $account->setDivision('Genève');
      $account->setComplement('C/o Calliopée Business Center');
      $account->setaddress('rue de Chantepoulet 10');
      $account->setPostal(1202);
      $account->setCity('Genève');
      $account->setCountry('Suisse');
      $account->setCurrency('CHF');
      $account->setIsValidatedAccount(true);
      $account->setCreatedAt(new \DateTimeImmutable());
      $account->setUpdatedAt(new \DateTimeImmutable());
      $manager->persist($account);

      $user = new User();
      $user->setLastName('Tourneux');
      $user->setFirstName('Maxence');
      $user->setEmail('tourneuxmaxence@gmail.com');
      $user->setPassword('$2y$10$5S4M0ZrUpjN4ptCRNQ/fneLdRTLCAA12bDi1y0zu8kxzFJAXAxAJO');
      $user->setMobile(33661136306);
      $user->setFonction('Fondateur');
      $user->setRole(60);
      $user->setIsValidatedEmail(true);
      $user->setCreatedAt(new \DateTimeImmutable());
      $user->setUpdatedAt(new \DateTimeImmutable());
      $user->setAccount($account);
      $manager->persist($user);

      $manager->flush();
    }
}
