<?php
namespace Generic;

use Psr\Http\Message\ResponseInterface;

class TestonsMiddleware
{
    public function __invoke($request, ResponseInterface $response, $next)
    {
        $response->getBody()->write('BEFORE');
        $response = $next($request, $response);
        $response->getBody()->write('AFTER');

        return $response;
    }
}