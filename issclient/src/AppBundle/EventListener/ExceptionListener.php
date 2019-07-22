<?php

// src/AppBundle/EventListener/ExceptionListener.php

namespace AppBundle\EventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof \DomainException) {
            return;
        }
        $event->setResponse(new JsonResponse(array(
            'error' => $exception->getMessage(),
        ), $exception->getCode()));
    }
}