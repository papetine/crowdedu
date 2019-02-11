<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
