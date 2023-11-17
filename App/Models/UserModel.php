<?php
/**
 * UserModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class UserModel extends Model
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $website;
    public $role;
    public $token;
    public $tokenExpire;

    public function __construct(ContainerInterface $container, String $id)
    {
        parent::__construct($container);

        $pdo = $this->pdoService->query("SELECT * FROM users WHERE id = '$id'");

        $this->id = $pdo[0]['id'];
        $this->username = $pdo[0]['username'];
        $this->password = $pdo[0]['password'];
        $this->email = $pdo[0]['email'];
        $this->website = $pdo[0]['website'];
        $this->role = $pdo[0]['role'];
        $this->token = $pdo[0]['token'];
        $this->tokenExpire = $pdo[0]['tokenexpire'];
    }

    public function editUser(): bool
    {
        return $this->pdoService->insert("UPDATE users SET username = '$this->username', password = '$this->password', email = '$this->email', website = '$this->website', role = '$this->role', token = '$this->token', tokenexpire = '$this->tokenExpire' WHERE id = '$this->id'");
    }

    public function delete(): bool
    {
        return $this->pdoService->delete("DELETE FROM users WHERE id = '$this->id'");
    }
}
