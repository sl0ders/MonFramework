<?php

namespace tests\Framework;

use Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Tests\Framework\Module\ErroredModule;
use Tests\Framework\Module\StringModule;

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

    public function testBlog()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
        $requestSingle = new ServerRequest('GET', '/blog/article-de-test');
        $responseSingle = $app->run($requestSingle);
        $this->assertStringContainsString('<h1>Bienvenue sur l\'article article-de-test</h1>', (string)$responseSingle->getBody());
    }

    public function testThrowExceptionIfNoResponseSend()
    {
        $app = new App([ErroredModule::class]);
        $request = new ServerRequest('Get', '/demo');
        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testConvertStringToResponse()
    {
        $app = new App([StringModule::class]);
        $request = new ServerRequest('Get', '/demo');
        $response = $app->run($request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('DEMO', (string)$response->getBody());
    }

    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest('Get', '/aze');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
