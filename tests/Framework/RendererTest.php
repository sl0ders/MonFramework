<?php
namespace Tests\Framework;

use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function setUp(): void
    {
        $this->renderer = new Renderer();
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('salut les gens', $content);
    }

    public function testRendererTheDefaultPath()
    {
        $this->renderer->addpath(__DIR__ . '/views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('salut les gens', $content);
    }
}
