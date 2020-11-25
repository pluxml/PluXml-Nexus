<?php

namespace App\Facades;

use App\Models\CategoriesModel;
use App\Models\CategoryModel;
use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\NewPluginModel;

/**
 * Class CategoriesFacade
 * @package App\Facades
 */
class CategoriesFacade extends Facade
{

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

    static public function getPluginsForCategory(ContainerInterface $container, string $categoryName)
    {
        $categoryModel = CategoriesFacade::getCategoryIdFromName($container, $categoryName);
        $pluginsModel = new PluginsModel($container, null, $categoryModel->id);
        return PluginsFacade::populatePluginsList($container, $pluginsModel);
    }

    /**
     * @param ContainerInterface $container
     * @param int $categoryId
     * @return CategoryModel
     */
    static public function getPluginCategory(ContainerInterface $container, int $categoryId)
    {
        return new CategoryModel($container, $categoryId);
    }

    private function getCategoryIdFromName(ContainerInterface $container, string $categoryName) {
        return new CategoryModel($container, null, $categoryName);
    }
}