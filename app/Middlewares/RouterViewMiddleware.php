<?php
/**
 * RouterViewMiddleware add a Slim 4 Router attribute to PHP View
 */
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteParser;

class RouterViewMiddleware
{

    private $viewService;
    private $routerService;

    public function __construct(PhpRenderer $viewService, RouteParser $routerService)
    {
        $this->viewService = $viewService;
        $this->routerService = $routerService;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $routerService = $this->routerService;
        $this->viewService->addAttribute('routerService', $routerService);
        $response = $handler->handle($request);
        return $response;
    }
}