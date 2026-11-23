<?php
/**
 * ThemesFacade
 */
namespace App\Facades;

use App\Models\NewThemeModel;
use App\Models\ThemeModel;
use App\Models\ThemesModel;
use Psr\Container\ContainerInterface;

class ThemesFacade extends Facade
{

    /**
     *
     * @param ContainerInterface $container
     * @param string|null $username
     * @return array|null
     */
    static public function getAllThemes(ContainerInterface $container, ?string $username = null)
    {
        if (isset($username)) {
            $userModel = UsersFacade::searchUser($container, $username);
            $themesModel = new ThemesModel($container, $userModel ? $userModel->id : '');
        } else {
            $themesModel = new ThemesModel($container);
        }

        return ThemesFacade::populateThemesList($container, $themesModel);
    }

    /**
     * @param ContainerInterface $container
     * @param string $name
     * @return array
     */
    static public function getTheme(ContainerInterface $container, string $name)
    {
        $datas = [];
        $themeModel = new ThemeModel($container, $name);
        if (!empty($themeModel->name)) {
            $datas['title'] = "Theme $themeModel->name Ressources - PluXml.org";
            $datas['name'] = $themeModel->name;
            $datas['description'] = $themeModel->description;
            $datas['versionTheme'] = $themeModel->versionTheme;
            $datas['versionPluxml'] = $themeModel->versionPluxml;
            $datas['link'] = $themeModel->link;
            $datas['file'] = $themeModel->file;
            $datas['author'] = Facade::getAuthorUsernameById($container, $themeModel->author);
        }
        return $datas;
    }

    /**
     *
     * @param ContainerInterface $container
     * @param array $theme
     * @return bool
     */
    static public function editTheme(ContainerInterface $container, array $theme): bool
    {
        $newThemeModel = new NewThemeModel($container, $theme);
        return $newThemeModel->updateTheme();
    }

    /**
     * @param ContainerInterface $container
     * @param array $theme
     * @return bool
     */
    static public function saveTheme(ContainerInterface $container, array $theme): bool
    {
        $newThemeModel = new NewThemeModel($container, $theme);
        return $newThemeModel->saveNewTheme();
    }

    /**
     * @param ContainerInterface $container
     * @param string $name
     * @return bool
     */
    static public function deleteTheme(ContainerInterface $container, string $name): bool
    {
        $themeModel = new ThemeModel($container, $name);
        $result = $themeModel->delete($container, $name);
        $file = $_SERVER['DOCUMENT_ROOT'] . DIR_THEMES . DIRECTORY_SEPARATOR . $name . '.zip';
        if ($result && file_exists($file)) {
            return unlink($file);
        }
        return $result;
    }

    /**
     * @param ContainerInterface $container
     * @param ThemesModel $themesModel
     * @return array|null
     */
    static public function populateThemesList(ContainerInterface $container, ThemesModel $themesModel): ?array
    {
        $themes = null;
        if (!empty($themesModel->themes)) {
            foreach ($themesModel->themes as $key => $value) {
                $themes[$key]['name'] = $value['name'];
                $themes[$key]['description'] = $value['description'];
                $themes[$key]['author'] = Facade::getAuthorUsernameById($container, $value['author']);
                $themes[$key]['versionTheme'] = $value['versiontheme'];
                $themes[$key]['versionPluxml'] = $value['versionpluxml'];
                $themes[$key]['link'] = $value['link'];
                $themes[$key]['file'] = $value['file'];
            }
        }
        return $themes;
    }
}