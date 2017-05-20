<?php

namespace AppBundle\Controller;

use AppBundle\Exception\InvalidCredentialsException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthenticateController extends AppController
{
    /**
     * @Route("/auth", name="auth_authenticate")
     * @Method("POST")
     */
    public function authenticateAction(Request $request) : JsonResponse
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

        $request->getSession()->set('token', $sessionToken);

        return $this->json(['token' => $sessionToken]);
    }

    /**
     * @Route("/logout", name="auth_unauthenticate")
     * @Method("GET")
     */
    public function unauthenticateAction(Request $request) : RedirectResponse
    {
        // should remove token from database ;)
        $request->getSession()->clear();

        return $this->redirectToRoute('homepage');
    }
}
