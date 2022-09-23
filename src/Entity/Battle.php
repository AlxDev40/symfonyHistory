<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BattleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: BattleRepository::class)]
class Battle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank()]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[NotBlank()]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[NotBlank()]
    private ?string $location = null;

    #[ORM\ManyToMany(targetEntity: Character::class, inversedBy: 'battles')]
    private Collection $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        $this->characters->removeElement($character);

        return $this;
    }
}
