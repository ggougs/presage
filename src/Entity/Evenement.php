<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $localisation;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;


     /**
     * @Assert\File(mimeTypes={ "image/png" ,"image/jpg","image/jpeg" })
     */
    private $imageUpload;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EvenementMisEnAvant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateEvenement;

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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

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

    public function getImageUpload(): ?string
    {
        return $this->imageUpload;
    }

    public function setImageUpload(?string $imageUpload): self
    {
        $this->imageUpload = $imageUpload;

        return $this;
    }

    public function getEvenementMisEnAvant(): ?string
    {
        return $this->EvenementMisEnAvant;
    }

    public function setEvenementMisEnAvant(?string $EvenementMisEnAvant): self
    {
        $this->EvenementMisEnAvant = $EvenementMisEnAvant;

        return $this;
    }

    public function getDateEvenement(): ?string
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(string $dateEvenement): self
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }
}
