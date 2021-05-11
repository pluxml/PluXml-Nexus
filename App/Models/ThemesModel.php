<?php
/**
 * ThemesModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class ThemesModel extends Model
{

    public $themes;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->themes = $this->pdoService->query('SELECT * FROM themes');
    }
}