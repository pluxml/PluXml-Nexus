<?php
/**
 * PluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class PluginsModel extends Model
{

    public $plugins;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->plugins = $this->pdoService->query('SELECT * FROM plugins');
    }
}