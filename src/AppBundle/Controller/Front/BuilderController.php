<?php

namespace AppBundle\Controller\Front;

use AppBundle\Controller\AppController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class BuilderController extends AppController
{
    /**
     * @Route("/builder", name="builder")
     * @Method("GET")
     */
    public function indexAction() : Response
    {
        return $this->render('builder/index.html.twig', [

        ]);
    }
}
