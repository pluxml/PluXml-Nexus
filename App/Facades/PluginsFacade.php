<?php

namespace App\Facades;

use App\Models\CategoriesModel;
use App\Models\CategoryModel;
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
     * @param string|null $username
     * @return array
     */
    static public function getAllPlugins(ContainerInterface $container, string $username = NULL)
    {
        $plugins = [];

        if (isset($username)) {
            $userModel = UsersFacade::searchUser($container, $username);
            $pluginsModel = new PluginsModel($container, $userModel->id);
        } else {
            $pluginsModel = new PluginsModel($container);
        }

        return PluginsFacade::populatePluginsList($container, $pluginsModel);
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
            $datas['file'] = $pluginModel->file;
            $datas['author'] = Facade::getAuthorUsernameById($container, $pluginModel->author);
            $datas['category'] = CategoriesFacade::getPluginCategory($container, $pluginModel->category)->id;
            $datas['categoryName'] = CategoriesFacade::getPluginCategory($container, $pluginModel->category)->name;
            $datas['categoryIcon'] = CategoriesFacade::getPluginCategory($container, $pluginModel->category)->icon;
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

    /**
     * @param ContainerInterface $container
     * @param string $name
     * @return bool
     */
    static public function deletePlugin(ContainerInterface $container, string $name)
    {
        $pluginModel = new PluginModel($container, $name);
        $pluginModel->delete($container, $name) != false;
        return unlink($_SERVER['DOCUMENT_ROOT'] . DIR_PLUGINS . DIRECTORY_SEPARATOR . $name . '.zip');
    }

    static public function populatePluginsList(ContainerInterface $container, PluginsModel $pluginsModel)
    {
        $plugins = null;

        if (!empty($pluginsModel)) {
            foreach ($pluginsModel->plugins as $key => $value) {
                $plugins[$key]['name'] = $value['name'];
                $plugins[$key]['description'] = $value['description'];
                $plugins[$key]['author'] = Facade::getAuthorUsernameById($container, $value['author']);
                $plugins[$key]['versionPlugin'] = $value['versionplugin'];
                $plugins[$key]['versionPluxml'] = $value['versionpluxml'];
                $plugins[$key]['link'] = $value['link'];
                $plugins[$key]['file'] = $value['file'];
                $plugins[$key]['categoryName'] = CategoriesFacade::getPluginCategory($container, $value['category'])->name;
                $plugins[$key]['categoryIcon'] = CategoriesFacade::getPluginCategory($container, $value['category'])->icon;
            }
        }

        return $plugins;
    }
}