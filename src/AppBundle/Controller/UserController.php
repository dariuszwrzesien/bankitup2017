<?php

namespace AppBundle\Controller;

use AppBundle\Query\GetUserByGuidQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AppController
{
    /**
     * @Route("/users/{guid}", name="user_details")
     * @Method("GET")
     * @param string $guid
     * @return JsonResponse
     */
    function detailsAction(string $guid): JsonResponse
    {
        $user = $this->queryDispatcher()->execute(new GetUserByGuidQuery($guid));

        return $this->json($user, Response::HTTP_OK);
    }
}
