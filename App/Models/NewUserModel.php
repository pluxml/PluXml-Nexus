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
        $this->website = !empty($user['website']) ? $user['website'] : NULL;

        $token = parent::generateToken();
        $this->token = $token['token'];
        $this->tokenExpire = $token['expire'];
    }

    public function saveNewUser(): bool
    {
        return $this->pdoService->insert("INSERT INTO users SET username = :username, password = :password, email = :email, website = :website, role = '', token = :token, tokenexpire = :tokenexpire", [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'website' => $this->website,
            'token' => $this->token,
            'tokenexpire' => $this->tokenExpire,
        ]);
    }

    public function updateUser(): bool
    {
        return $this->pdoService->insert('UPDATE users SET email = :email, website = :website WHERE username = :username', [
            'email' => $this->email,
            'website' => $this->website,
            'username' => $this->username,
        ]);
    }
}
