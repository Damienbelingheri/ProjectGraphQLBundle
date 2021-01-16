<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AstronautRepository")
 */
class Astronaut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * 
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $pseudo;

    /**
     * @ORM\ManyToOne(targetEntity="Grade")
     * @ORM\JoinColumn(nullable=false, name="grade_id", referencedColumnName="id")
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="astronauts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, mappedBy="captain", cascade={"persist", "remove"})
     */
    private $captainTeam;

    /**
     * Get the value of grade
     */ 
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     *
     * @return  self
     */ 
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getCaptainTeam(): ?Team
    {
        return $this->captainTeam;
    }

    public function setCaptainTeam(?Team $captainTeam): self
    {
        // unset the owning side of the relation if necessary
        if ($captainTeam === null && $this->captainTeam !== null) {
            $this->captainTeam->setCaptain(null);
        }

        // set the owning side of the relation if necessary
        if ($captainTeam !== null && $captainTeam->getCaptain() !== $this) {
            $captainTeam->setCaptain($this);
        }

        $this->captainTeam = $captainTeam;

        return $this;
    }
}