<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['getAccounts', 'getUsers'])]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The company name cannot be empty.')]
    #[Assert\Length(min: 2, max: 55, minMessage: 'the company name must be at least {{ limit }} characters long', maxMessage: 'the company name must have a maximum of {{ limit }} characters')]
    private ?string $company = null;

    #[ORM\Column(length: 55, nullable: true)]
    #[Groups(['getAccounts'])]
    private ?string $division = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[Groups(['getAccounts'])]
    private ?string $complement = null;

    #[ORM\Column(length: 150)]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The address cannot be empty.')]
    #[Assert\Length(min: 5, max: 150, minMessage: 'the address must be at least {{ limit }} characters long', maxMessage: 'the address must have a maximum of {{ limit }} characters')]
    private ?string $address = null;

    #[ORM\Column]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The postal code cannot be empty.')]
    #[Assert\Length(min: 4, max: 7, minMessage: 'the postal code must be at least {{ limit }} characters long', maxMessage: 'the postal code must have a maximum of {{ limit }} characters')]
    private ?int $postal = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The city cannot be empty.')]
    #[Assert\Length(min: 2, max: 50, minMessage: 'the city must be at least {{ limit }} characters long', maxMessage: 'the city must have a maximum of {{ limit }} characters')]
    private ?string $city = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The country cannot be empty.')]
    #[Assert\Length(min: 2, max: 50, minMessage: 'the country must be at least {{ limit }} characters long', maxMessage: 'the country must have a maximum of {{ limit }} characters')]
    private ?string $country = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[Groups(['getAccounts'])]
    private ?string $matricule = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[Groups(['getAccounts'])]
    private ?string $status = null;

    #[ORM\Column(length: 10)]
    #[Groups(['getAccounts'])]
    #[Assert\NotBlank(message: 'The currency cannot be empty.')]
    #[Assert\Length(min: 1, max: 10, minMessage: 'the currency must be at least {{ limit }} characters long', maxMessage: 'the currency must have a maximum of {{ limit }} characters')]
    private ?string $currency = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getAccounts'])]
    private ?bool $isValidatedAccount = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getAccounts'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['getAccounts'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: User::class, orphanRemoval: true)]
    #[Groups(['getAccounts'])]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(?string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostal(): ?int
    {
        return $this->postal;
    }

    public function setPostal(int $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function isIsValidatedAccount(): ?bool
    {
        return $this->isValidatedAccount;
    }

    public function setIsValidatedAccount(?bool $isValidatedAccount): self
    {
        $this->isValidatedAccount = $isValidatedAccount;

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAccount($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAccount() === $this) {
                $user->setAccount(null);
            }
        }

        return $this;
    }
}
