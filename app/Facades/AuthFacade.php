<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;

class AuthFacade extends Facade
{

    static public function getAllPlugins(ContainerInterface $container)
    {
        $pluginsModel = new PluginsModel($container);

        $datas['title'] = 'Plugins Ressources - PluXml.org';
        $datas['plugins'] = $pluginsModel->plugins;

        return $datas;
    }

    static public function getPlugin(ContainerInterface $container, String $name)
    {
        $pluginModel = new PluginModel($container, $name);

        $datas['title'] = "Plugin $pluginModel->name Ressources - PluXml.org";
        $datas['name'] = $pluginModel->name;
        $datas['description'] = $pluginModel->description;
        $datas['versionPlugin'] = $pluginModel->versionPlugin;
        $datas['versionPluxml'] = $pluginModel->versionPluxml;
        $datas['link'] = $pluginModel->link;
        $datas['author'] = Facade::getAuthorUsernameById($container, $pluginModel->author);

        return $datas;
    }
}