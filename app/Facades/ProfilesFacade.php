<?php
/**
 * ProfilesFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\UsersModel;
use App\Models\UserModel;
use App\Models\PluginsModel;
use App\Models\PluginModel;

class ProfilesFacade
{

    static public function getAllProfiles(ContainerInterface $container)
    {
        $usersModel = new UsersModel($container);

        $datas['title'] = 'Profiles Ressources - PluXml.org';
        $datas['profiles'] = $usersModel->users;

        return $datas;
    }

    static public function getProfile(ContainerInterface $container, String $username)
    {
        $userModels = $usersModel = new UsersModel($container);

        // Search userid by the username
        foreach ($userModels->users as $k => $v)
            if (in_array($username, $v)) {
                $key = $k;
                break;
            }
        $userId = $userModels->users[$key]['id'];
        $userModel = new UserModel($container, $userId);

        $datas['title'] = "Profile $userModel->username Ressources - PluXml.org";
        $datas['username'] = $userModel->username;
        $datas['website'] = $userModel->website;

        $datas['plugins'] = self::getPluginsByProfile($container, $userId);
        return $datas;
    }
    
    private function getPluginsByProfile(ContainerInterface $container, String $userid) {
        $pluginsModel = new PluginsModel($container, $userid);
        foreach ($pluginsModel->plugins as $plugin) {
            $pluginModel = new PluginModel($container, $plugin['name']);
            $plugins[]['name'] = $pluginModel->name;
        }
        return $plugins;
    }
}