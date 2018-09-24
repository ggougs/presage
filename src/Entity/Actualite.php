<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualiteRepository")
 */
class Actualite
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @Assert\File(mimeTypes={ "image/png" ,"image/jpg","image/jpeg" })
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ActuMisEnAvant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateActualite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getActuMisEnAvant(): ?string
    {
        return $this->ActuMisEnAvant;
    }

    public function setActuMisEnAvant(?string $ActuMisEnAvant): self
    {
        $this->ActuMisEnAvant = $ActuMisEnAvant;

        return $this;
    }

    public function getDateActualite(): ?string
    {
        return $this->dateActualite;
    }

    public function setDateActualite(?string $dateActualite): self
    {
        $this->dateActualite = $dateActualite;

        return $this;
    }
}
