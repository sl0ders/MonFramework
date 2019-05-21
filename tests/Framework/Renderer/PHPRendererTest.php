<?php

namespace Tests\Framework;

use Framework\Renderer\PHPRenderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /**
     * @var PHPRenderer
     */
    private $renderer;

    public function setUp(): void
    {
        $this->renderer = new PHPRenderer(__DIR__ . '/views');
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('salut les gens', $content);
    }

    public function testRendererTheDefaultPath()
    {

        $content = $this->renderer->render('demo');
        $this->assertEquals('salut les gens', $content);
    }

    public function testRendererWithParams()
    {
        $content = $this->renderer->render('demoparams', ['nom' => 'Marc']);
        $this->assertEquals('Salut Marc', $content);
    }

    public function testGlobalParameters()
    {
        $this->renderer->addGlobal('nom', 'Marc');
        $this->assertEquals('Salut Marc', $content);
    }
}
