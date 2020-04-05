<?php
/**
 * PagesController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\PluginsFacade;

class PluginsController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response)
    {
        $datas = PluginsFacade::getAllPlugins($this->container);
        return $this->render($response, 'pages/plugins.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showPlugin(Request $request, Response $response, $args)
    {
        $datas = PluginsFacade::getNamedPlugin($this->container, $args['pluginName']);
        return $this->render($response, 'pages/plugin.php', $datas);
    }
}