<?php
/**
 * BackofficeController
 */
namespace App\Controllers;

use App\Facades\AuthFacade;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class BackofficeController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response): Response
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['adminUser'] = AuthFacade::isAdmin($this->container, $this->currentUser);

        return $this->render($response, self::VIEW_BO_USERS, $datas);
    }
}