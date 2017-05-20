<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\AuthenticateController;
use AppBundle\Exception\AccessDeniedException;
use AppBundle\Repository\AuthRepositoryInterface;
use AppBundle\Service\AuthUserService;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class TokenListener
{
    private $authRepository;
    private $authUserService;

    public function __construct(AuthRepositoryInterface $authRepository, AuthUserService $authUserService)
    {
        $this->authRepository = $authRepository;
        $this->authUserService = $authUserService;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $tokenFromQueryParam = (string)$event->getRequest()->query->get('token', '');
        $tokenFromHttpHeader = (string)$event->getRequest()->headers->get('X-Authorization', '');
        $token = empty($tokenFromQueryParam) ? $tokenFromHttpHeader : $tokenFromQueryParam;
        $controller = $event->getController()[0];

        if (($controller instanceof AuthenticateController) === false
            && ($controller instanceof ExceptionController) === false
        ) {
            $user = $this->authRepository->getUserByTokenKey($token);

            if ($user->isAnonymous()) {
                throw new AccessDeniedException();
            }

            $this->authUserService->setUser($user);
        }
    }
}
