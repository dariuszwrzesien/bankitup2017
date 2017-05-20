<?php

namespace AppBundle\Controller\Front;

use AppBundle\Controller\AppController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Query\GetPaymentsQuery;

class PaymentController extends AppController
{
    /**
     * @Route("/payments", name="payments")
     * @Method("GET")
     */
    public function indexAction() : Response
    {
        $userId = $this->authUser()->getUserId();
        return $this->render('payment/index.html.twig', [
            'payments' => $user = $this->queryDispatcher()->execute(new GetPaymentsQuery($userId)),
        ]);
    }
}
