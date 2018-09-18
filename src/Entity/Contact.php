<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "votre nom doit comporter au moins {{ limit }} lettres",
     *      maxMessage = "votre nom ne doit pas comporter plus de {{ limit }} lettres"
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     *@Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "votre prenom doit comporter au moins {{ limit }} lettres",
     *      maxMessage = "votre prénom ne doit pas comporter plus de {{ limit }} lettres"
     *)
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

   /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
