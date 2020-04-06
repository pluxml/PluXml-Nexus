<?php
/**
 * Facade
 */
namespace App\Facades;

use Psr\Container\ContainerInterface;
use App\Models\UserModel;

class Facade
{

    static public function getAuthorUsernameById(ContainerInterface $container, Int $id)
    {
        $userModel = new UserModel($container, $id);
        return $userModel->username;
    }
}