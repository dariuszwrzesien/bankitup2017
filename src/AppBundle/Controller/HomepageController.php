<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AppController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() : JsonResponse
    {
        return $this->json(null, Response::HTTP_OK);
    }
}
