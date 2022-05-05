<?php
namespace App\MessageHandler;

use App\Message\OrderNotification;
use App\Service\Google\GoogleClient;
use Google\Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OrderNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var GoogleClient
     */
    private GoogleClient $googleClient;

    /**
     * @param GoogleClient $googleClient
     */
    public function __constructor(GoogleClient $googleClient)
    {
        $this->googleClient = $googleClient;
    }

    /**
     * @param OrderNotification $message
     * @throws Exception
     */
    public function __invoke(OrderNotification $message)
    {
        //send messages to google sheets
        $this->googleClient->getClient();
    }
}