<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends ApiController
{
    /**
     * @Route("/api/payments", name="payment_to_pay")
     * @Method("GET")
     * @return JsonResponse
     */
    function toPayAction(): JsonResponse
    {
        return $this->json([
            [
                'id' => 1,
                'name' => 'Czynsz za mieszkanie',
                'amount' => 60000,
                'currency' => 'PLN'
            ],
            [
                'id' => 2,
                'name' => 'Faktura PLAY',
                'amount' => 12200,
                'currency' => 'PLN'
            ]
        ], Response::HTTP_OK);
    }
}
