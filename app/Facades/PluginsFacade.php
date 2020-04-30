<?php

namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\NewPluginModel;

/**
 * Class PluginsFacade
 * @package App\Facades
 */
class PluginsFacade extends Facade
{

    /**
     *
     * @param ContainerInterface $container
     * @param String $username
     * @return string
     */
    static public function getAllPlugins(ContainerInterface $container, string $username = NULL)
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
            $datas['plugins'][$key]['versionPlugin'] = $value['versionplugin'];
            $datas['plugins'][$key]['versionPluxml'] = $value['versionpluxml'];
            $datas['plugins'][$key]['website'] = $value['link'];
            $datas['plugins'][$key]['link'] = $value['file'];
        }

        return $datas;
    }

    /**
     * @param ContainerInterface $container
     * @param String $name
     * @return mixed
     */
    static public function getPlugin(ContainerInterface $container, string $name)
    {
        $datas = [];
        $pluginModel = new PluginModel($container, $name);

        if (!empty($pluginModel->name)) {
            $datas['title'] = "Plugin $pluginModel->name Ressources - PluXml.org";
            $datas['name'] = $pluginModel->name;
            $datas['description'] = $pluginModel->description;
            $datas['versionPlugin'] = $pluginModel->versionPlugin;
            $datas['versionPluxml'] = $pluginModel->versionPluxml;
            $datas['link'] = $pluginModel->link;
            $datas['author'] = Facade::getAuthorUsernameById($container, $pluginModel->author);
        }

        return $datas;
    }

    /**
     *
     * @param ContainerInterface $container
     * @param array $plugin
     * @return bool
     */
    static public function editPlugin(ContainerInterface $container, array $plugin)
    {
        $newPluginModel = new NewPluginModel($container, $plugin);
        return $newPluginModel->updatePlugin();
    }

    /**
     * @param ContainerInterface $container
     * @param array $plugin
     * @return bool
     */
    static public function savePlugin(ContainerInterface $container, array $plugin)
    {
        $newPluginModel = new NewPluginModel($container, $plugin);
        return $newPluginModel->saveNewPlugin();
    }
}