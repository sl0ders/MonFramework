<?php

namespace Tests\Framework\Module;

use Framework\Router;

class ErroredModule
{
    public function __construct(Router $router)
    {
        $router->get('/demo', function () {
            return new \stdClass();
        }, 'demo');
    }
}
