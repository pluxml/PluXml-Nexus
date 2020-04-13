<?php
/**
 * Middleware all midlewares parent to provide PHO-DI container's services 
 */
namespace App\Middlewares;

use Psr\Container\ContainerInterface;

class Middleware
{

    protected $csrfService;

    protected $flashService;

    protected $pdoService;

    protected $routerService;

    protected $viewService;

    protected $isLogged;

    public function __construct(ContainerInterface $container)
    {
        $this->csrfService = $container->get('csrf');
        $this->flashService = $container->get('flash');
        $this->pdoService = $container->get('pdo');
        $this->routerService = $container->get('router');
        $this->viewService = $container->get('view');
    }
}