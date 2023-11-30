<?php


/**
 * BackofficeThemesController
 */
namespace App\Controllers;

use App\Facades\ThemesFacade;
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
    public function show(Request $request, Response $response): Response
    {
        $datas = [];
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Themes';
        $datas['themes'] = ThemesFacade::getAllThemes($this->container, $this->currentUser);

        return $this->render($response, 'pages/backoffice/themes.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showAddTheme(Request $request, Response $response): Response
    {
        $datas = [];
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'New theme';

        return $this->render($response, 'pages/backoffice/addTheme.php', $datas);
    }
}
