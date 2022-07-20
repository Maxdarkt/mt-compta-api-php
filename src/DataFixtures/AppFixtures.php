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
    $usersList = '
    [
      {
        "accountId": 1,
        "lastName": "Tourneux",
        "firstName": "Maxence",
        "email": "tourneuxmaxence@gmail.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "3361136306",
        "fonction": "Fondateur",
        "role": 60,
        "isValidatedEmail": true
      },
      {
        "accountId": 1,
        "lastName": "Archibald",
        "firstName": "Gregory",
        "email": "gregory.archibald@woy-sante.ch",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0642123406",
        "fonction": "Moderateur",
        "role": 30,
        "isValidatedEmail": true
      },
      {
        "accountId": 1,
        "lastName": "Convenant",
        "firstName": "Jean-Claude",
        "email": "jc.convenant@woy-sante.ch",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0611223344",
        "fonction": "Commercial",
        "role": 20,
        "isValidatedEmail": true
      },
      {
        "accountId": 1,
        "lastName": "Pineau",
        "firstName": "Roger",
        "email": "roger.pineau@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0791296209",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Reynaud",
        "firstName": "Julie",
        "email": "julie.reynaud@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0615224578",
        "fonction": "RH",
        "role": 50,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Boisson",
        "firstName": "Paul",
        "email": "paul.boisson@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0758452356",
        "fonction": "DAF",
        "role": 40,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Creton",
        "firstName": "Clemence",
        "email": "clemence.creton@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0645127889",
        "fonction": "Assistante RH",
        "role": 30,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Jourdan",
        "firstName": "Valentine",
        "email": "valentine.jourdan@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0771118314",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Collet",
        "firstName": "Daniel",
        "email": "daniel.collet@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0763182770",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 2,
        "lastName": "Renaud",
        "firstName": "Virginie",
        "email": "virginie.renaud@ibm.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0679561801",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Talend",
        "firstName": "Sarah",
        "email": "sarah.talend@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0713633791",
        "fonction": "RH",
        "role": 50,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Tardy",
        "firstName": "Pierre",
        "email": "pierre.tardy@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0699658132",
        "fonction": "DAF",
        "role": 40,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Vellut",
        "firstName": "Sebastien",
        "email": "sebastien.vellut@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0616497858",
        "fonction": "Assistant RH",
        "role": 30,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Godard",
        "firstName": "Bernard",
        "email": "bernard.godard@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0679561801",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Mary",
        "firstName": "Xavier",
        "email": "xavier.mary@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0788122232",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 3,
        "lastName": "Berthellot",
        "firstName": "Célina",
        "email": "célina.berthellot@mcdonald\"s.com",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0700608389",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Roche",
        "firstName": "Pauline",
        "email": "pauline.roche@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0618784987",
        "fonction": "RH",
        "role": 50,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Amberg",
        "firstName": "Richard",
        "email": "richard.amberg@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0697631325",
        "fonction": "DAF",
        "role": 40,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Rigan",
        "firstName": "Serge",
        "email": "serge.rigan@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0616497858",
        "fonction": "Assistant RH",
        "role": 30,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Giraud",
        "firstName": "Patrick",
        "email": "patrick.giraud@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0772161897",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Colas",
        "firstName": "Elsa",
        "email": "elsa.colas@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0741783685",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      },
      {
        "accountId": 4,
        "lastName": "Fournier",
        "firstName": "Anna",
        "email": "anna.fournier@ubs.fr",
        "password": "$2y$10$tKfqa/zpXR.gzp.qh9TMOuj2N35i9rUjrn13Wzb/KIXy94uKoRfH6",
        "mobile": "0698330195",
        "fonction": "operateur",
        "role": 10,
        "isValidatedEmail": true
      }
    ]';
    
    $accountsList = '
    [
      {
        "company": "Mt-develop",
        "division": "Suisse",
        "complement": "c/o Calliopée Business Center",
        "address": "Route de Chantepoulet 10",
        "postal": 1202,
        "city": "Genève",
        "country": "Suisse",
        "matricule": null,
        "status": "EI",
        "currency": "CHF",
        "isValidatedAccount": true
      },  
      {
        "company": "IBM",
        "division": "France",
        "complement": "Bâtiment A",
        "address": "17 avenue de l\'europe",
        "postal": 92270,
        "city": "Bois-Colombes",
        "country": "France",
        "matricule": "552118465",
        "status": "SA",
        "currency": "€",
        "isValidatedAccount": true
      },
      {
        "company": "Mc Donald\'s",
        "division": "France",
        "complement": null,
        "address": "1 rue Gustave Eiffel",
        "postal": 78280,
        "city": "Guyancourt",
        "country": "France",
        "matricule": "722003936",
        "status": "SA",
        "currency": "€",
        "isValidatedAccount": true
      },
      {
        "company": "UBS",
        "division": "France",
        "complement": null,
        "address": "69 Boulevard Haussmann",
        "postal": 75008,
        "city": "Paris",
        "country": "France",
        "matricule": "421255670",
        "status": "SA",
        "currency": "€",
        "isValidatedAccount": true
      }
    ]';
    
    $jsonAccounts = json_decode($accountsList, true);
    $jsonUsers = json_decode($usersList, true);

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
