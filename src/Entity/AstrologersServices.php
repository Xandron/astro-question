<?php


namespace App\Entity;

use App\Entity\Traits\ObserveChangesTrait;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Forms
 * @package App\Entity
 * @ORM\Table(name="astrologers_services")
 * @ORM\Entity(repositoryClass="App\Repository\AstrologerServicesRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="entity")
 */
class AstrologersServices implements EntityInterface, ObserveChangesInterface
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
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="astrologer_service")
     */
    private $id;

    /**
     * @ORM\Column(
     *     type="float",
     *     length=11,
     *     nullable=true,
     *     name="price",
     *     options={"comment":"Astrologer service price"}
     * )
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Astrologers", inversedBy="services", cascade={"persist"})
     * @ORM\JoinColumn(name="astrologer_id", referencedColumnName="id")
     */
    private $astrologer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Services", inversedBy="astrologers", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Astrologers|null
     */
    public function getAstrologer(): ?Astrologers
    {
        return $this->astrologer;
    }

    /**
     * @param Astrologers|null $astrologer
     * @return AstrologersServices
     */
    public function setAstrologer(?Astrologers $astrologer): self
    {
        $this->astrologer = $astrologer;
        return $this;
    }

    /**
     * @return Services|null
     */
    public function getService(): ?Services
    {
        return $this->service;
    }

    /**
     * @param Services|null $service
     * @return AstrologersServices
     */
    public function setService(?Services $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return double
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param double $price
     * @return AstrologersServices
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}