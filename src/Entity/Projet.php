<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="blob")
     */
    private $photo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $parcoursEdu;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $opportinute;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $attentes;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $motivation;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $perspective;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours", inversedBy="projets",cascade = {"persist"})
     */
    private $cour;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Don", mappedBy="projet",cascade={"remove"}, orphanRemoval=true)
     *
     */
    private $dons;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projets",cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean")
     */
    private $subvention;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getParcoursEdu(): ?string
    {
        return $this->parcoursEdu;
    }

    public function setParcoursEdu(string $parcoursEdu): self
    {
        $this->parcoursEdu = $parcoursEdu;

        return $this;
    }

    public function getOpportinute(): ?string
    {
        return $this->opportinute;
    }

    public function setOpportinute(string $opportinute): self
    {
        $this->opportinute = $opportinute;

        return $this;
    }

    public function getAttentes(): ?string
    {
        return $this->attentes;
    }

    public function setAttentes(string $attentes): self
    {
        $this->attentes = $attentes;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getPerspective(): ?string
    {
        return $this->perspective;
    }

    public function setPerspective(string $perspective): self
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSubvention(): ?bool
    {
        return $this->subvention;
    }

    public function setSubvention(bool $subvention): self
    {
        $this->subvention = $subvention;

        return $this;
    }
}
