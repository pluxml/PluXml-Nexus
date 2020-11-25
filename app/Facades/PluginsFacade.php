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

        foreach ($pluginsModel->plugins as $key => $value) {
            $plugins[$key]['name'] = $value['name'];
            $plugins[$key]['description'] = $value['description'];
            $plugins[$key]['author'] = Facade::getAuthorUsernameById($container, $value['author']);
            $plugins[$key]['versionPlugin'] = $value['versionplugin'];
            $plugins[$key]['versionPluxml'] = $value['versionpluxml'];
            $plugins[$key]['link'] = $value['link'];
            $plugins[$key]['file'] = $value['file'];
            $plugins[$key]['categoryName'] = PluginsFacade::getPluginCategory($container, $value['category'])->name;
            $plugins[$key]['categoryIcon'] = PluginsFacade::getPluginCategory($container, $value['category'])->icon;
        }

        return $plugins;
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
            $datas['category'] = PluginsFacade::getPluginCategory($container, $pluginModel->category)->id;
            $datas['categoryName'] = PluginsFacade::getPluginCategory($container, $pluginModel->category)->name;
            $datas['categoryIcon'] = PluginsFacade::getPluginCategory($container, $pluginModel->category)->icon;
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

    /**
     * @param ContainerInterface $container
     * @return array
     */
    static public function getCategories(ContainerInterface $container)
    {
        $categories = [];
        $categoriesModel = new CategoriesModel($container);

        foreach ($categoriesModel->categories as $category => $value) {
            $categories[$category]['id'] = $value['id'];
            $categories[$category]['name'] = $value['name'];
        }

        return $categories;
    }

    /**
     * @param ContainerInterface $container
     * @param int $id
     * @return CategoryModel
     */
    static private function getPluginCategory(ContainerInterface $container, int $id)
    {
        return new CategoryModel($container, $id);
    }
}