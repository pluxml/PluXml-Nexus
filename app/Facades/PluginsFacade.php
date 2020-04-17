<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\NewPluginModel;

class PluginsFacade extends Facade
{

    /**
     *
     * @param ContainerInterface $container
     * @param String $username
     * @return string
     */
    static public function getAllPlugins(ContainerInterface $container, String $username = NULL)
    {
        if (isset($username)) {
            $userModel = UsersFacade::searchUser($container, $username);
            $pluginsModel = new PluginsModel($container, $userModel->id);
        } else {
            $pluginsModel = new PluginsModel($container);
        }

        $datas['title'] = 'Plugins Ressources - PluXml.org';
        foreach ($pluginsModel->plugins as $key => $value) {
            $datas['plugins'][$key]['name'] = $value['name'];
            $datas['plugins'][$key]['description'] = $value['description'];
            $datas['plugins'][$key]['author'] = $value['author'];
            $datas['plugins'][$key]['versionPlugin'] = $value['versionPlugin'];
            $datas['plugins'][$key]['versionPluxml'] = $value['versionPluxml'];
            $datas['plugins'][$key]['link'] = $value['link'];
        }

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

    static public function editPlugin(ContainerInterface $container, Array $plugin){
        $newPluginModel = new NewPluginModel($container, $plugin);
        return $newPluginModel->updatePlugin();
    }
}