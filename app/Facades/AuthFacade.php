<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;

class AuthFacade extends Facade
{

    static public function authentificateUser(ContainerInterface $container, String $username, String $password)
    {
        $result = FALSE;
        $userPassword = UsersFacade::getProfilePassword($container, $username);

        if (! empty($userPassword) and $userPassword == $password) {
            $result = TRUE;
        }

        return $result;
    }
}