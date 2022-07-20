<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 55)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $password = null;

    #[ORM\Column(length: 15)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $mobile = null;

    #[ORM\Column(length: 55, nullable: true)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?string $fonction = null;

    #[ORM\Column]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?int $role = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?bool $isValidatedEmail = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['getUsers', 'getAccounts'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['getUsers'])]
    private ?Account $account = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(?string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function isIsValidatedEmail(): ?bool
    {
        return $this->isValidatedEmail;
    }

    public function setIsValidatedEmail(?bool $isValidatedEmail): self
    {
        $this->isValidatedEmail = $isValidatedEmail;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
