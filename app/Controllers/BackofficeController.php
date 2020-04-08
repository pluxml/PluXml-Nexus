<?php
/**
 * BackofficeController
 */
namespace App\Controllers;

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
    public function show(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';

        return $this->render($response, 'pages/backoffice/backoffice.php', $datas);
    }
}
?>