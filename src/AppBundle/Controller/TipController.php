<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PayAssistantBundle\Command\GiveTipCommand;

class TipController extends AppController
{
    /**
     * @Route("/tips", name="give_tip")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function giveTipAction(Request $request): JsonResponse
    {
        $this->commandBus()->handle(new GiveTipCommand(
            $this->auth()->getUserId(),
            (string)$request->request->get('recipient_guid'),
            (int)$request->request->get('amount'),
            (string)$request->request->get('message'),
            new \DateTime()
        ));

        return $this->json(null, Response::HTTP_CREATED);
    }
}
