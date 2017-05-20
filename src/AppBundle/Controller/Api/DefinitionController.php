<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PayAssistantBundle\Command\CreateDefinitionCommand;

class DefinitionController extends ApiController
{
    /**
     * @Route("/definitions/create", name="definition_create")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $this->commandBus()->handle(new CreateDefinitionCommand(
            (string) $request->request->get('name'),
            (string) $request->request->get('transfer_iban'),
            (string) $request->request->get('transfer_name')
        ));

        return $this->json(null, Response::HTTP_CREATED);
    }
}
