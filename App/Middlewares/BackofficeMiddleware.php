<?php
/**
 * IsLoggedMiddleware
 */
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Container\ContainerInterface;
use App\Facades\AuthFacade;
use Slim\Psr7\Response as SlimResponse;

class BackofficeMiddleware extends Middleware
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        // Check the authentication before running the backoffice action
        if (! AuthFacade::isLogged()) {
            $this->flashService->addMessage('error', 'Auhtentification needed');
            return (new SlimResponse())->withHeader('Location', $this->routerService->urlFor('auth'))->withStatus(302);
        }
        return $handler->handle($request);
    }
}