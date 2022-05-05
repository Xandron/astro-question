<?php


namespace App\Entity;

use App\Entity\Traits\ObserveChangesTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Forms
 * @package App\Entity
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="entity")
 */
class Orders implements EntityInterface, ObserveChangesInterface
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
     *     options={"comment":"Customer name"}
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=false,
     *     name="email",
     *     options={"comment":"Customer email"}
     * )
     */
    private $email;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=false,
     *     name="address",
     *     options={"comment":"Customer address"}
     * )
     */
    private $address;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false,
     *     name="status",
     *     options={"comment":"Order status"}
     * )
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="AstrologersServices", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="astrologer_setvice_id", referencedColumnName="id")
     */
    private $astrologer_service;

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
     * @return Orders
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Orders
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Orders
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
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
     * @return Orders
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return AstrologersServices
     */
    public function getAstrologerService(): AstrologersServices
    {
        return $this->astrologer_service;
    }

    /**
     * @param AstrologersServices $astrologer_service
     * @return Orders
     */
    public function setAstrologerService(AstrologersServices $astrologer_service): self
    {
        $this->astrologer_service = $astrologer_service;
        return $this;
    }
}