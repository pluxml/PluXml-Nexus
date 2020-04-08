<?php
/**
 * FormOldValuesMiddleware store in $_SESSION the form values
 */
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\PhpRenderer;

class FormOldValuesMiddleware
{

    private $viewService;

    public function __construct(PhpRenderer $viewService)
    {
        $this->viewService = $viewService;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $formOldValues = isset($_SESSION['formOldValues']) ? $_SESSION['formOldValues'] : [];
        if (isset($_SESSION['formOldValues'])) {
            unset($_SESSION['formOldValues']);
        }
        $this->viewService->addAttribute('formOldValues', $formOldValues);
        $response = $handler->handle($request);
        if ($response->getStatusCode() === 302){
            $_SESSION['formOldValues'] = $request->getParsedBody();
            $_SESSION['formOldValues']['password'] = '';
        }
        return $response;
    }
}