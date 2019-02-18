<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChapitreRepository")
 */
class Chapitre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreChapitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours", inversedBy="chapitres",cascade={"persist"})
     */
    private $cour;

     /**
     * @Gedmo\Slug(fields={"titreChapitre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreChapitre(): ?string
    {
        return $this->titreChapitre;
    }

    public function setTitreChapitre(string $titreChapitre): self
    {
        $this->titreChapitre = $titreChapitre;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the value of cour
     */ 
    public function getCour()
    {
        return $this->cour;
    }

    /**
     * Set the value of cour
     *
     * @return  self
     */ 
    public function setCour($cour)
    {
        $this->cour = $cour;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
