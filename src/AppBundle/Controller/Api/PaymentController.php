<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ApiController;
use AppBundle\Query\GetPaymentsToDoQuery;
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
        $payments = $this->queryDispatcher()->execute(new GetPaymentsToDoQuery($this->authUser()->getUserId()));

        return $this->json($payments, Response::HTTP_OK);
    }
}
