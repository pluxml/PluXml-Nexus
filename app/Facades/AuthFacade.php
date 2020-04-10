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
    
    static public function sendConfirmationEmail(ContainerInterface $container, String $username)
    {
        $userModel = UsersFacade::searchUser($container, $username);
        
        $body = strtr(MAIL_NEWUSER_BODY, '##TOKEN##', $userModel->token);
        
        $result = $container->get('mail')->sendMail(MAIL_FROM, MAIL_FROM_NAME, $userModel->email, $userModel->username, MAIL_NEWUSER_SUBJECT, $body, TRUE);

        var_dump($result);

        return $result;
    }
}