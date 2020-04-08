<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;

class AuthFacade extends Facade
{

    /**
     * @param ContainerInterface $container
     * @param String $username
     * @param String $password
     * @return boolean
     */
    static public function authentificateUser(ContainerInterface $container, String $username, String $password)
    {
        $result = FALSE;
        $userPassword = UsersFacade::getProfilePassword($container, $username);

        if (! empty($userPassword) and $userPassword == $password) {
            $result = TRUE;
            $_SESSION['user'] = $username;
        }

        return $result;
    }

    /**
     * @return boolean
     */
    static public function isLogged()
    {
        $result = FALSE;

        if (isset($_SESSION['user'])) {
            $result = TRUE;
        }

        return $result;
    }
    
    /**
     * 
     */
    static public function logout() {
        unset($_SESSION['user']);
    }
}