<?php
/**
 * ThemesController
 */
namespace App\Controllers;

use App\Facades\ThemesFacade;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ThemesController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response)
    {
        $datas = [];
        $datas['activeTab'] = 2;
        $datas['title'] = 'Themes Ressources - PluXml.org';
        $datas['themes'] = ThemesFacade::getAllThemes($this->container);
        return $this->render($response, 'pages/themes.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showTheme(Request $request, Response $response, $args)
    {
        $datas = ThemesFacade::getTheme($this->container, $args['name']);
        if (empty($datas)) {
            return $this->redirect($response, 'themes');
        }
        $datas['activeTab'] = 2;
        return $this->render($response, 'pages/theme.php', $datas);
    }
}