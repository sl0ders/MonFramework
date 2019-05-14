<?php

namespace tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use http\Env\Request;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testRedirectTrainingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }
}