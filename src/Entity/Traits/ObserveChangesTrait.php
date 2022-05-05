<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait ObserveChangesTrait
{
    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     options={"comment":"Дата создания"}
     * )
     */
    private $created;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     nullable=true,
     *     options={"comment":"Дата редактирования"}
     * )
     */
    private $updated;

    /**
     * @return DateTime|null
     */
    public function created(): ?DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     * @return $this
     */
    public function setCreated(DateTime $created): self
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function updated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     * @return $this
     */
    public function setUpdated(DateTime $updated): self
    {
        $this->updated = $updated;
        return $this;
    }
}