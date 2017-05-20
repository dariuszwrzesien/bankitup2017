<?php

namespace AppBundle\Controller;

use AppBundle\Exception\InvalidCredentialsException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class AuthenticateController extends AppController
{
    /**
     * @Route("/auth", name="auth")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->json([]);
    }

    /**
     * @Route("/auth", name="auth_authenticate")
     * @Method("POST")
     */
    public function authenticateAction(Request $request)
    {
        $auth = $this->get('app.service.auth');
        $sessionToken = uniqid();

        $authenticated = $auth->authenticate(
            (string)$request->request->get('username', ''),
            (string)$request->request->get('password', ''),
            $sessionToken
        );

        if (!$authenticated) {
            throw new InvalidCredentialsException();
        }

        return $this->json([
            'token' => $sessionToken
        ]);
    }
}
