<?php
/**
 * ProfilesFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\PluginsModel;
use App\Models\PluginModel;
use App\Models\UsersModel;
use App\Models\UserModel;

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
        $userModel = new UserModel($container, $username);

        $datas['title'] = "Profile $pluginModel->name Ressources - PluXml.org";
        $datas['username'] = $userModel->username;

        return $datas;
    }
}