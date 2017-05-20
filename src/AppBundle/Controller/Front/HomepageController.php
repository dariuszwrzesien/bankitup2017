<?php

namespace AppBundle\Controller\Front;

use AppBundle\Controller\AppController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AppController
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction() : Response
    {
        return $this->render('homepage/index.html.twig');
    }

    /**
     * @Route("/howto", name="howto")
     * @Method("GET")
     */
    public function howToAction() : Response
    {
        return $this->render('homepage/howto.html.twig');
    }

    /**
     * @Route("/login", name="login")
     * @Method("GET")
     */
    public function loginAction() : Response
    {
        if ($this->authUser()->isAuthenticated()) {
            return $this->redirectToRoute('builder');
        }

        return $this->render('homepage/login.html.twig');
    }
}
