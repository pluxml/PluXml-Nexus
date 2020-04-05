<?php
/**
 * PluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class ThemeModel extends Model
{

    private $theme;

    public $name;

    public $description;

    public $author;

    public $date;

    public $version;

    public $versionPluxml;

    public $link;

    public $file;

    public function __construct(ContainerInterface $container, String $name)
    {
        parent::__construct($container);
        $this->plugin = $this->pdoService->query('select * from themes where name=' . $name);
    }
}