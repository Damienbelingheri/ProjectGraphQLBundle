<?php

namespace App\Entity;

use App\Repository\RocketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RocketRepository::class)
 */
class Rocket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, mappedBy="rocket", cascade={"persist", "remove"})
     */
    private $team;


    public function __construct()
    {
        $this->planets = new ArrayCollection();
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

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        // unset the owning side of the relation if necessary
        if ($team === null && $this->team !== null) {
            $this->team->setRocket(null);
        }

        // set the owning side of the relation if necessary
        if ($team !== null && $team->getRocket() !== $this) {
            $team->setRocket($this);
        }

        $this->team = $team;

        return $this;
    }

    /**
     * @return Collection|Planet[]
     */
    public function getPlanets(): Collection
    {
        return $this->planets;
    }
    
}
