<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;

class PluginsFacade
{

    static public function getAllPlugins(ContainerInterface $container)
    {
        $pluginsModel = new PluginsModel($container);

        $datas['title'] = 'Plugins Ressources - PluXml.org';
        $datas['plugins'] = $pluginsModel->plugins;

        return $datas;
    }

    static public function getNamedPlugin(ContainerInterface $container, String $name)
    {
        $pluginModel = new PluginModel($container, $name);

        $datas['title'] = "Plugin $pluginModel->name Ressources - PluXml.org";
        $datas['pluginName'] = $pluginModel->name;

        return $datas;
    }
}