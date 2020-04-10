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
    
    private $tokenExpire;

    public function __construct(ContainerInterface $container, Array $user)
    {
        parent::__construct($container);

        $this->username = $user['username'];
        $this->password = self::generateHashedPassword($user['password']);
        $this->email = $user['email'];
        $this->website = $user['website'];
        
        $token = self::generateToken();
        $this->token = $token['token']; 
        $this->tokenExpire = $token['expire'];
    }

    /**
     *
     * @return Bool
     */
    public function saveNewUser()
    {
        return $this->pdoService->insert("INSERT INTO users SET username = '$this->username', password = '$this->password', email = '$this->email', website = '$this->website', role = '', token = '$this->token', tokenexpire = '$this->tokenExpire'");
    }

    private function generateHashedPassword(String $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     *
     * @return Array keys are 'token' and 'expire' 
     */
    private function generateToken()
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        $lifetime = 24; //hours
        
        $token['token'] = substr(str_shuffle(str_repeat($alphabet, self::TOKEN_LENGH)), 0, self::TOKEN_LENGH);
        $token['expire'] = date('Y-m-d H:i:s', mktime(date('H')+$lifetime, date('i'), date('s'), date('m'), date('d'), date('Y')));
        
        return $token;
    }
}