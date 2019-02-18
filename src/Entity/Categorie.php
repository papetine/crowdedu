<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libelle;
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cours", mappedBy="categorie")
     */
    private $cours;

    /**
     * @ORM\Column(type="blob")
     */
    private $imgC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImgC()
    {
        return $this->imgC;
    }

    public function setImgC($imgC): self
    {
        $this->imgC = $imgC;

        return $this;
    }


}
