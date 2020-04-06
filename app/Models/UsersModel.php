<?php
/**
 * UsersModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class UsersModel extends Model
{

    public $users;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->users = $this->pdoService->query('SELECT * FROM users');
    }
}