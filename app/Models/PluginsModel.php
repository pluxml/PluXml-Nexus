<?php
/**
 * PluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class PluginsModel extends Model
{

    public $plugins;

    public function __construct(ContainerInterface $container, String $userid = NULL)
    {
        parent::__construct($container);

        if (! empty($userid)) {
            $this->plugins = $this->pdoService->query("SELECT * FROM plugins WHERE author='$userid'");
        } else {
            $this->plugins = $this->pdoService->query('SELECT * FROM plugins');
        }
    }
}