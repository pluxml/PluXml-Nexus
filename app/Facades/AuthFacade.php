<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use PhpParser\Node\Expr\Array_;

class AuthFacade extends Facade
{

    /**
     *
     * @param ContainerInterface $container
     * @param String $username
     * @param String $password
     * @return boolean
     */
    static public function authentificateUser(ContainerInterface $container, String $username, String $password)
    {
        $result = FALSE;
        $userModel = UsersFacade::searchUser($container, $username);

        if (! empty($userModel) and ! empty($userModel->role) and $userModel->password == $password) {
            $result = TRUE;
            $_SESSION['user'] = $username;
        }

        return $result;
    }

    /**
     *
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
     */
    static public function logout()
    {
        unset($_SESSION['user']);
    }
}