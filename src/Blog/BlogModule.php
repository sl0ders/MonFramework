<?php


namespace App\Blog;

use Framework\Renderer\RendererInterface;
use Framework\Router;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule
{
    private $renderer;

    /**
     * BlogModule constructor.
     * @param Router $router
     * @param RendererInterface $renderer
     */
    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z\-0-9]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request): string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(Request $request): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $request->getAttribute('slug')]);
    }
}
