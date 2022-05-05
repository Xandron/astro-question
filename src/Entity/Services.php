<?php


namespace App\Entity;

use App\Entity\Traits\ObserveChangesTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Forms
 * @package App\Entity
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="entity")
 */
class Services implements EntityInterface, ObserveChangesInterface
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
     *     options={"comment":"Service name"}
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false,
     *     name="status",
     *     options={"comment":"Service status"}
     * )
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="AstrologersServices", mappedBy="service")
     */
    private $astrologers;

    public function __construct()
    {
        $this->astrologers = new ArrayCollection();
    }

    /**
     * @return Collection|Astrologers[]
     */
    public function getServices(): Collection
    {
        return $this->astrologers;
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
     * @return Services
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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
     * @return Services
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }
}