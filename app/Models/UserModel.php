<?php
/**
 * PluginModel
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
        $this->plugin = $this->pdoService->query('select * from themes where name=' . $username);
    }
}