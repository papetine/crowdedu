<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
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
    private $evaluation;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours", inversedBy="commentaires",cascade={"persist"})
     */
    private $cour;
 /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaires",cascade={"persist"})
     */
    private $user;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }
}
