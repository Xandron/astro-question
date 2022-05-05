<?php
namespace App\Message;

class OrderNotification
{
    /**
     * @var array
     */
    private array $order;

    /**
     * OrderNotification constructor.
     * @param array $order
     */
    public function __construct(array $order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }
}