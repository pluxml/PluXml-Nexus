<?php
/**
 * UsersModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class UsersModel extends Model
{

    public $users;

    public function __construct(ContainerInterface $container, bool $withPluginsFilter = false)
    {
        parent::__construct($container);

        if ($withPluginsFilter) {
            $this->users = $this->pdoService->query('SELECT * FROM users JOIN plugins p ON users.id = p.author GROUP BY username');
        } else {
            $this->users = $this->pdoService->query('SELECT * FROM users');
        }
    }
}