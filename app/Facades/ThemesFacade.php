<?php
/**
 * ThemesFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\ThemesModel;
use App\Models\ThemeModel;

class ThemesFacade
{

    static public function getAllThemes(ContainerInterface $container)
    {
        $themesModel = new ThemesModel($container);

        $datas['title'] = 'Themes Ressources - PluXml.org';
        $datas['themes'] = $themesModel->themes;

        return $datas;
    }

    static public function getTheme(ContainerInterface $container, String $name)
    {
        $themeModel = new ThemeModel($container, $name);

        $datas['title'] = "Theme $themeModel->name Ressources - PluXml.org";
        $datas['name'] = $themeModel->name;
        return $datas;
    }
}