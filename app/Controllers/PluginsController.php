<?php
/**
 * PagesController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator;
use App\Models\PluginsModel;
use App\Models\PluginModel;

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
        $pluginsModel = new PluginsModel($this->container);

        $datas['title'] = 'Plugins Ressources - PluXml.org';
        $datas['plugins'] = $pluginsModel->plugins; 

        // View call
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
        $pluginModel = new PluginModel($this->container, $args['pluginName']);

        $datas['title'] = "Plugin $pluginModel->name Ressources - PluXml.org";
        $datas['pluginName'] = $pluginModel->name;

        // View call
        return $this->render($response, 'pages/plugin.php', $datas);
    }
}
?>