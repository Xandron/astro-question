<?php

namespace App\Controller;

use App\Message\OrderNotification;
use App\Service\OrderService;
use App\Validator\OrderValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/order/pay", name="app_order", methods="POST")
     * @param Request $request
     * @param OrderValidator $orderValidator
     * @param OrderService $orderService
     * @return Response
     * @throws Exception
     */
    public function pay(
        Request $request,
        OrderValidator $orderValidator,
        OrderService $orderService
    ): Response {

        $params = [
            'name'                  => $request->get('name'),
            'email'                 => $request->get('email'),
            'address'               => $request->get('address'),
            'astrologer_service_id' => $request->get('astrologer-service-id')
        ];

        $violations = $orderValidator->validation($params);

        if ($violations->count()) {
            throw new Exception($violations);
        }

        $status = $orderService->process($params);

        $message = new OrderNotification($params);
        $this->dispatchMessage($message);

        return $this->json(
            ['status' => $status ? 'OK' : 'Error']
        );
    }

}
