<?php

namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\UsersModel;
use App\Models\UserModel;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\NewUserModel;

/**
 * Class UsersFacade
 * @package App\Facades
 */
class UsersFacade
{

    /**
     *
     * @param ContainerInterface $container
     * @return string $datas
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
     * @param string $username
     * @param bool $withPlugins add user's plugins name to the view datas
     * @return String $datas
     */
    static public function getProfile(ContainerInterface $container, string $username, bool $withPlugins = true)
    {
        $userModel = self::searchUser($container, $username);

        $datas['title'] = "Profile $userModel->username Ressources - PluXml.org";
        $datas['username'] = $userModel->username;
        $datas['email'] = $userModel->email;
        $datas['website'] = $userModel->website;

        if ($withPlugins) {
            $datas['plugins'] = self::getPluginsByProfile($container, $userModel->id);
        }
        return $datas;
    }

    /**
     *
     * @param ContainerInterface $container
     * @param string $username
     * @return UserModel
     */
    static public function searchUser(ContainerInterface $container, string $username)
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

        if (!empty($userId)) {
            $userModel = new UserModel($container, $userId);
        }

        return $userModel;
    }

    /**
     * @param ContainerInterface $container
     * @param array $user
     * @return bool
     */
    static public function addUser(ContainerInterface $container, array $user)
    {
        $newUserModel = new NewUserModel($container, $user);
        return $newUserModel->saveNewUser();
    }

    static public function editUser(ContainerInterface $container, array $user)
    {
        $newUserModel = new NewUserModel($container, $user);
        return $newUserModel->updateUser();
    }

    /**
     *
     * @param ContainerInterface $container
     * @param string $userid
     * @return array
     */
    static private function getPluginsByProfile(ContainerInterface $container, string $userid)
    {
        $plugins = [];
        $pluginsModel = new PluginsModel($container, $userid);
        foreach ($pluginsModel->plugins as $plugin) {
            $pluginModel = new PluginModel($container, $plugin['name']);
            $plugins[]['name'] = $pluginModel->name;
        }
        return $plugins;
    }
}