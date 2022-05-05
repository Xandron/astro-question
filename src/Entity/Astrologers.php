<?php


namespace App\Entity;

use App\Entity\Traits\ObserveChangesTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Forms
 * @package App\Entity
 * @ORM\Table(name="astrologers")
 * @ORM\Entity(repositoryClass="App\Repository\AstrologersRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="entity")
 */
class Astrologers implements EntityInterface, ObserveChangesInterface
{
    use ObserveChangesTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(
     *     type="integer",
     *     unique=true,
     *     length=11,
     *     nullable=false,
     *     options={"unsigned":true, "comment":"ID"}
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=false,
     *     name="name",
     *     options={"comment":"Astrologer name"}
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true,
     *     name="bio",
     *     options={"comment":"Astrologer biography"}
     * )
     */
    private $bio;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true,
     *     name="personal",
     *     options={"comment":"Astrologer personal information"}
     * )
     */
    private $personal;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     unique=true,
     *     name="email",
     *     options={"comment":"Astrologer email"}
     * )
     */
    private $email;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     name="image",
     *     options={"comment":"Astrologer personal photograohy"}
     * )
     */
    private $image;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false,
     *     name="status",
     *     options={"comment":"Astrologer status"}
     * )
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="AstrologersServices", mappedBy="astrologer")
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Astrologers
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * @param string|null $bio
     * @return Astrologers
     */
    public function setBio(?string $bio): self
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPersonal(): ?string
    {
        return $this->personal;
    }

    /**
     * @param string|null $personal
     * @return Astrologers
     */
    public function setPersonal(?string $personal): self
    {
        $this->personal = $personal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Astrologers
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Astrologers
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Astrologers
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }
}