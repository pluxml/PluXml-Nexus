<?php
/**
 * UsersFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\UsersModel;
use App\Models\UserModel;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\NewUserModel;

class UsersFacade
{

    /**
     *
     * @param ContainerInterface $container
     * @return String $datas
     */
    static public function getAllProfiles(ContainerInterface $container)
    {
        $usersModel = new UsersModel($container);

        $datas['title'] = 'Profiles Ressources - PluXml.org';
        $datas['profiles'] = $usersModel->users;

        return $datas;
    }

    /**
     *
     * @param ContainerInterface $container
     * @param String $username
     * @return String $datas
     */
    static public function getProfile(ContainerInterface $container, String $username)
    {
        $userModel = self::searchUser($container, $username);

        $datas['title'] = "Profile $userModel->username Ressources - PluXml.org";
        $datas['username'] = $userModel->username;
        $datas['website'] = $userModel->website;

        $datas['plugins'] = self::getPluginsByProfile($container, $userModel->id);
        return $datas;
    }

    /**
     *
     * @param ContainerInterface $container
     * @param String $username
     * @return \App\Models\UserModel
     */
    static public function searchUser(ContainerInterface $container, String $username)
    {
        $userModel = NULL;
        $userModels = new UsersModel($container);

        // Search userid by the username
        foreach ($userModels->users as $k => $v)
            if (in_array($username, $v)) {
                $key = $k;
                break;
            }
        $userId = $userModels->users[$key]['id'];

        if (! empty($userId)) {
            $userModel = new UserModel($container, $userId);
        }

        return $userModel;
    }

    static public function addUser(ContainerInterface $container, Array $user)
    {
        $newUserModel = new NewUserModel($container, $user);
        return $newUserModel->saveNewUser($user);
    }

    /**
     *
     * @param ContainerInterface $container
     * @param String $userid
     * @return Array
     */
    private function getPluginsByProfile(ContainerInterface $container, String $userid)
    {
        $pluginsModel = new PluginsModel($container, $userid);
        foreach ($pluginsModel->plugins as $plugin) {
            $pluginModel = new PluginModel($container, $plugin['name']);
            $plugins[]['name'] = $pluginModel->name;
        }
        return $plugins;
    }
}