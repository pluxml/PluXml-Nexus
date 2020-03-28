<?php
/**
 * CsrfMiddleware is in charge of CSRF tokens generation
 */
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Csrf\Guard;
use Slim\Views\PhpRenderer;

class CsrfTokenMiddleware
{

    private $csrfService;

    private $viewService;

    public function __construct(PhpRenderer $viewService, Guard $csrfService)
    {
        $this->viewService = $viewService;
        $this->csrfService = $csrfService;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $csrf['nameKey'] = $this->csrfService->getTokenNameKey();
        $csrf['valueKey'] = $this->csrfService->getTokenValueKey();
        $csrf['name'] = $request->getAttribute($csrf['nameKey']);
        $csrf['value'] = $request->getAttribute($csrf['valueKey']);

        $this->viewService->addAttribute('csrf', $csrf);

        $response = $handler->handle($request);
        return $response;
    }
}