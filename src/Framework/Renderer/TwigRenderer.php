<?php


namespace Framework\Renderer;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRenderer implements RendererInterface
{
    private $twig;
    private $loader;

    public function __construct(Twig_Loader_Filesystem $loader, Twig_Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }

    /**
     * permet de rajouter un chemin pour charger les vues
     * @param string $namespace
     * @param string|null $path
     * @throws \Twig_Error_Loader
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * permet de rendre une vue
     * le chemin peut etre précisé avec des namespace rajoutés via le addPath()
     * @param string $view
     * @param array $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.twig', $params);
    }

    /**
     * permet de rajouter des variable globale a toute les vue
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}
