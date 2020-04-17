<?php
/**
 * Controller
 */
namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class Controller
{

    protected $container;

    protected $routerService;

    protected $viewService;

    protected $messageService;

    protected $mailService;

    protected $currentUser;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->routerService = $this->container->get('router');
        $this->viewService = $this->container->get('view');
        $this->messageService = $this->container->get('flash');
        $this->mailService = $this->container->get('mail');
        $this->currentUser = $_SESSION['user'];
    }

    /**
     * HTTP redirect
     *
     * @param Response $response
     * @param String $namedRoute
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function redirect(Response $response, $namedRoute, $args, $status = 302)
    {
        return $response->withHeader('Location', $this->routerService->urlFor($namedRoute, $args))
            ->withStatus($status);
    }

    /**
     * PHP view renderer
     *
     * @param Response $response
     * @param String $filename
     * @param Array $datas
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function render(Response $response, $filename, $datas = [])
    {
        $datas['flash'] = $this->messageService->getMessages();
        return $this->viewService->render($response, $filename, $datas);
    }
}