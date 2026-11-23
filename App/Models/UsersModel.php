<?php
/**
 * UsersModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class UsersModel extends Model
{

    public $users;

    public function __construct(ContainerInterface $container, bool $withPluginsFilter = false, bool $withThemesFilter = false)
    {
        parent::__construct($container);

        if ($withPluginsFilter || $withThemesFilter) {
            $conditions = [];
            if ($withPluginsFilter) {
                $conditions[] = 'EXISTS (SELECT 1 FROM plugins WHERE plugins.author = users.id)';
            }
            if ($withThemesFilter) {
                $conditions[] = 'EXISTS (SELECT 1 FROM themes WHERE themes.author = users.id)';
            }
            $this->users = $this->pdoService->query(
                'SELECT users.* FROM users WHERE ' . implode(' OR ', $conditions)
            );
        } else {
            $this->users = $this->pdoService->query('SELECT * FROM users');
        }
    }

    public function delete()
    {
        return $this->pdoService->query('SELECT * FROM users');;
    }
}