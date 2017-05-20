<?php

namespace AppBundle\EventListener;

use AppBundle\Controller\AuthenticateController;
use AppBundle\Controller\Front\HomepageController;
use AppBundle\Exception\AccessDeniedException;
use AppBundle\Repository\AuthRepositoryInterface;
use AppBundle\Service\AuthUserService;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;
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
        $controller = $event->getController()[0];
        $tokenFromQueryParam = (string)$event->getRequest()->query->get('token', '');
        $tokenFromHttpHeader = (string)$event->getRequest()->headers->get('X-Authorization', '');
        $tokenFromSession = (string)$event->getRequest()->getSession()->get('token', '');
        $sessionToken = array_values(array_filter([$tokenFromQueryParam, $tokenFromHttpHeader, $tokenFromSession]))[0] ?? '';
        $user = $this->authRepository->getUserBySessionToken($sessionToken);

        if (($controller instanceof HomepageController) === false
            && ($controller instanceof AuthenticateController) === false
            && ($controller instanceof ExceptionController) === false
            && ($controller instanceof ProfilerController) === false
        ) {
            if ($user->isAnonymous()) {
                throw new AccessDeniedException();
            }
        }

        $this->authUserService->setUser($user);
    }
}
