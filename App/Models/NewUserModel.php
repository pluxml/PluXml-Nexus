<?php
/**
 * NewUserModel
 */

namespace App\Models;

use Psr\Container\ContainerInterface;

class NewUserModel extends Model
{
    private $username;
    private $password;
    private $email;
    private $website;
    private $token;
    private $tokenExpire;

    public function __construct(ContainerInterface $container, array $user)
    {
        parent::__construct($container);

        $this->username = $user['username'];
        $this->password = password_hash($user['password'], PASSWORD_BCRYPT);
        $this->email = $user['email'];

        $token = parent::generateToken();
        $this->token = $token['token'];
        $this->tokenExpire = $token['expire'];
    }

    public function saveNewUser(): bool
    {
        return $this->pdoService->insert("INSERT INTO users SET username = '$this->username', password = '$this->password', email = '$this->email', website = '$this->website', role = '', token = '$this->token', tokenexpire = '$this->tokenExpire'");
    }

    public function updateUser(): bool
    {
        return $this->pdoService->insert("UPDATE users SET email = '$this->email', website = '$this->website' WHERE username = '$this->username'");
    }
}
