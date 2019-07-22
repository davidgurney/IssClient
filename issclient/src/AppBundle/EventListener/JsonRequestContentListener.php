<?php
// src/AppBundle/EventListener/JsonRequestContentListener.php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * PHP does not populate $_POST with the data submitted via a JSON Request,
 * causing an empty $request->request.
 */
class JsonRequestContentListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $hasBeenSubmited = in_array($request->getMethod(), array('PATCH', 'POST', 'PUT'), true);
        $isJson = (1 === preg_match('#application/json#', $request->headers->get('Content-Type')));
        if (!$hasBeenSubmited || !$isJson) {
            return;
        }
        $data = json_decode($request->getContent(), true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $event->setResponse(new JsonResponse('{"error":"Invalid or malformed JSON"}', 400));
        }
        $request->request->add($data ?: array());
    }
}
