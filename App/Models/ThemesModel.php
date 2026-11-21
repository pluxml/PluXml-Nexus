<?php
/**
 * ThemesModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class ThemesModel extends Model
{

    public $themes;

    public function __construct(ContainerInterface $container, string $userid = null)
    {
        parent::__construct($container);

        if (!empty($userid)) {
            $this->themes = $this->pdoService->query('SELECT * FROM themes WHERE author = :author', ['author' => $userid]);
        } else {
            $this->themes = $this->pdoService->query('SELECT * FROM themes');
        }
    }
}