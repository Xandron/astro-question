<?php

namespace App\Controller;

use App\Service\AstrologersService;
use App\Validator\AstrologerValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AstrologersController extends AbstractController
{

    /**
     * @Route("/astrologers/", name="app_astrologers", methods="GET")
     * @param AstrologersService $astrologersService
     * @return Response
     */
    public function index(AstrologersService $astrologersService): Response
    {
        return $this->json($astrologersService->getList());
    }

    /**
     * @Route("/astrologers/{id}", name="app_astrologer_info", methods="GET")
     * @param int $id
     * @param AstrologersService $astrologersService
     * @param AstrologerValidator $astrologerValidator
     * @return Response
     * @throws Exception
     */
    public function detail(
        int $id,
        AstrologersService $astrologersService,
        AstrologerValidator $astrologerValidator
    ): Response {
        $params = [
           'id' => $id
        ];

        $violations = $astrologerValidator->validation($params);

        if ($violations->count()) {
            throw new Exception($violations);
        }

        return $this->json($astrologersService->getDetail($id));
    }
}
