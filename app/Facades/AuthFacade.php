<?php
/**
 * PluginsFacade 
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;

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

        $host = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $tokenHref = $container->get('router')->urlFor('confirmEmail') . "?username=$userModel->username&token=$userModel->token";
        $placeholder = [
            '##USERNAME##' => $userModel->username,
            '##TOKEN##' => '<p><a href="' . $host . $tokenHref . '">' . $host . $tokenHref . '</a></p>'
        ];
        $body = str_replace(array_keys($placeholder), array_values($placeholder), MAIL_NEWUSER_BODY);

        $result = $container->get('mail')->sendMail(MAIL_FROM, MAIL_FROM_NAME, $userModel->email, $userModel->username, MAIL_NEWUSER_SUBJECT, $body, TRUE);

        return $result;
    }

    static public function confirmEmail(ContainerInterface $container, String $username, String $token)
    {
        $result = FALSE;

        $userModel = UsersFacade::searchUser($container, $username);

        if (isset($userModel->token) and isset($userModel->tokenExpire)) {
            if ($userModel->token == $token and $userModel->tokenExpire >= date('Y-m-d H:i:s')) {
                $userModel->role = 'user';
                $userModel->token = NULL;
                $userModel->tokenExpire = '0000-00-00 00:00:00';
                $userModel->editUser();
                $result = TRUE;
            }
        }

        return $result;
    }
}