<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ApiController;
use AppBundle\Query\GetUserByIdQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends ApiController
{
    /**
     * @Route("/api/profile", name="profile_details")
     * @Method("GET")
     * @return JsonResponse
     */
    function detailsAction(): JsonResponse
    {
        $profile = $this->queryDispatcher()->execute(new GetUserByIdQuery(
            $this->authUser()->getUserId()
        ));

        return $this->json($profile, Response::HTTP_OK);
    }
}
