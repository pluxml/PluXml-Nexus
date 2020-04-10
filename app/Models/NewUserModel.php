<?php
/**
 * NewUserModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class NewUserModel extends Model
{

    private const TOKEN_LENGH = 60;

    private $username;

    private $password;

    private $email;

    private $website;

    private $token;

    public function __construct(ContainerInterface $container, Array $user)
    {
        parent::__construct($container);

        $this->username = $user['username'];
        $this->password = self::generateHashedPassword($user['password']);
        $this->email = $user['email'];
        $this->website = $user['website'];
        $this->token = self::generateToken();
    }

    /**
     *
     * @return Bool
     */
    public function saveNewUser()
    {
        return $this->pdoService->insert("INSERT INTO users SET username = '$this->username', password = '$this->password', email = '$this->email', website = '$this->website', role = '', token = '$this->token'");
    }

    private function generateHashedPassword(String $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     *
     * @return String
     */
    private function generateToken()
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, self::TOKEN_LENGH)), 0, self::TOKEN_LENGH);
    }
}