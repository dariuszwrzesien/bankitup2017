<?php

namespace AppBundle\EventListener;

use AppBundle\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use PayAssistantBundle\Exception\ResourceDoesNotExistException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    protected $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) : void
    {
        $this->setupApiException($event);
    }

    private function mapExceptionToStatusCode(\Exception $exception) : int
    {
        if ($exception instanceof AccessDeniedException) {
            return Response::HTTP_FORBIDDEN;
        }

        if ($exception instanceof ResourceDoesNotExistException) {
            return Response::HTTP_NOT_FOUND;
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    private function mapExceptionToResponseData(\Exception $exception) : array
    {
        $message = ['error' => $exception->getMessage()];

        if ($this->kernel->getEnvironment() === 'dev') {
            $message['class'] = get_class($exception);
            $message['file'] = $exception->getFile();
            $message['line'] = $exception->getLine();
            $message['trace'] = $exception->getTrace();
        }

        return $message;
    }

    private function setupApiException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpExceptionInterface) {
            return;
        }

        $response = new JsonResponse(
            $this->mapExceptionToResponseData($exception),
            $this->mapExceptionToStatusCode($exception)
        );

        $event->setResponse($response);
    }
}
