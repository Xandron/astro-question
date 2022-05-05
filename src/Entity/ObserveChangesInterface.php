<?php

declare(strict_types=1);

namespace App\Entity;

interface ObserveChangesInterface
{
    public function created(): ?\DateTime;

    public function setCreated(\DateTime $created): self;

    public function updated(): \DateTime;

    public function setUpdated(\DateTime $updated);
}