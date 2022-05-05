<?php


namespace App\Service;


use App\Entity\AstrologersServices;
use App\Entity\Orders;
use App\Repository\AstrologerServicesRepository;
use App\Repository\OrdersRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class OrderService
{
    /**
     * @var OrdersRepository
     */
    private OrdersRepository $ordersRepository;

    /**
     * @var AstrologerServicesRepository
     */
    private AstrologerServicesRepository $astrologerServicesRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var ProducerInterface
     */
    private ProducerInterface $producer;

    /**
     * OrderService constructor.
     *
     * @param OrdersRepository $ordersRepository
     * @param AstrologerServicesRepository $astrologerServicesRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        OrdersRepository $ordersRepository,
        AstrologerServicesRepository $astrologerServicesRepository,
        EntityManagerInterface $entityManager

    ) {
        $this->ordersRepository = $ordersRepository;
        $this->astrologerServicesRepository = $astrologerServicesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function process(array $data): bool
    {
        $astrologerService = $this->astrologerServicesRepository
            ->findOneBy(['id' => $data['astrologer_service_id']]);

        $order = $this->prepareOrder($data, $astrologerService);
        $this->entityManager->beginTransaction();
        try {
            $this->entityManager->persist($order);
            $this->entityManager->flush();
            $this->entityManager->commit();
            $this->producer->publish('test');

            return true;
        } catch (\Exception $exception) {
            $this->entityManager->rollback();
            return false;
        }
    }

    /**
     * @param array $data
     * @param AstrologersServices $astrologerService
     * @return Orders
     */
    private function prepareOrder(array $data, AstrologersServices $astrologerService): Orders
    {
        $dateNow = new DateTime;

        $order = new Orders();
        $order->setName($data['name']);
        $order->setEmail($data['email']);
        $order->setAddress($data['address']);
        $order->setAstrologerService($astrologerService);
        $order->setStatus(true);
        $order->setCreated($dateNow);
        $order->setUpdated($dateNow);

        return $order;
    }

}