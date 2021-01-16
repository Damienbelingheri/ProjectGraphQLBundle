<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
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
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;


    /**
     * @ORM\OneToMany(targetEntity=Astronaut::class, mappedBy="team")
     */
    private $astronauts;

    /**
     * @ORM\OneToOne(targetEntity=Rocket::class, inversedBy="team", cascade={"persist", "remove"})
     */
    private $rocket;

    /**
     * @ORM\OneToOne(targetEntity=Astronaut::class, inversedBy="captainTeam", cascade={"persist", "remove"})
     */
    private $captain;

    public function __construct()
    {
        $this->astronauts = new ArrayCollection();
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getAstronauts(): Collection
    {
        return $this->astronauts;
    }

    public function addAstronaut(Astronaut $astronaut): self
    {
        if (!$this->astronauts->contains($astronaut)) {
            $this->astronauts[] = $astronaut;
            $astronaut->setTeam($this);
        }

        return $this;
    }

    public function removeAstronaut(Astronaut $astronaut): self
    {
        if ($this->astronauts->removeElement($astronaut)) {
            // set the owning side to null (unless already changed)
            if ($astronaut->getTeam() === $this) {
                $astronaut->setTeam(null);
            }
        }

        return $this;
    }

    public function getRocket(): ?Rocket
    {
        return $this->rocket;
    }

    public function setRocket(?Rocket $rocket): self
    {
        $this->rocket = $rocket;

        return $this;
    }

    public function getCaptain(): ?Astronaut
    {
        return $this->captain;
    }

    public function setCaptain(?Astronaut $captain): self
    {
        $this->captain = $captain;

        return $this;
    }
}
