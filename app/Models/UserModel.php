<?php
/**
 * UserModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class UserModel extends Model
{

    private $user;

    public $username;

    public $password;

    public $email;

    public $website;

    public function __construct(ContainerInterface $container, String $username)
    {
        parent::__construct($container);

        $pdo = $this->pdoService->query("SELECT * FROM users WHERE username = '$username'");

        $this->username = $pdo[0]['username'];
        $this->password = $pdo[0]['password'];
        $this->email = $pdo[0]['email'];
        $this->website = $pdo[0]['website'];
    }
}