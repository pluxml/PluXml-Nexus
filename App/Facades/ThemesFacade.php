<?php
/**
 * ThemesFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\ThemesModel;
use App\Models\ThemeModel;

class ThemesFacade extends Facade
{

    static public function getAllThemes(ContainerInterface $container)
    {
        $themesModel = new ThemesModel($container);

        $datas['title'] = 'Themes Ressources - PluXml.org';
        foreach ($themesModel->themes as $key => $value) {
            $themes[$key]['name'] = $value['name'];
            $themes[$key]['description'] = $value['description'];
            $themes[$key]['author'] = $value['author'];
            $themes[$key]['versionTheme'] = $value['versionTheme'];
            $themes[$key]['versionPluxml'] = $value['versionPluxml'];
            $themes[$key]['link'] = $value['link'];
        }

        return $themes;
    }

    static public function getTheme(ContainerInterface $container, String $name)
    {
        $themeModel = new ThemeModel($container, $name);

        $datas['title'] = "Plugin $themeModel->name Ressources - PluXml.org";
        $datas['name'] = $themeModel->name;
        $datas['description'] = $themeModel->description;
        $datas['versionTheme'] = $themeModel->versionTheme;
        $datas['versionPluxml'] = $themeModel->versionPluxml;
        $datas['link'] = $themeModel->link;
        $datas['author'] = Facade::getAuthorUsernameById($container, $themeModel->author);

        return $datas;
    }
}