<?php
/**
 * BackofficeThemesController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class BackofficeThemesController extends Controller
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
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Themes';

        return $this->render($response, 'pages/backoffice/themes.php', $datas);
    }
}
?>