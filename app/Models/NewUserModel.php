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

    public function __construct(ContainerInterface $container, Array $user)
    {
        parent::__construct($container);

        $this->username = $user['username'];
        $this->password = $user['password']; // TODO chiffrer le password via une méthode
        $this->email = $user['email'];
        $this->website = $user['website'];
        //$this->token = //TODO créer le token via une méthode
    }

    public function saveNewUser()
    {
        return $this->pdoService->insert("INSERT INTO users SET username = '$this->username', password = '$this->password', email = '$this->email', website = '$this->website', role = '', token = '$this->token'");
    }
}