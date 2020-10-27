<?php
/**
 * PluginModel
 */

namespace App\Models;

use Psr\Container\ContainerInterface;

class PluginModel extends Model
{

    public $name;

    public $description;

    public $author;

    public $date;

    public $versionPlugin;

    public $versionPluxml;

    public $link;

    public $file;

    public function __construct(ContainerInterface $container, string $name)
    {
        parent::__construct($container);

        $pdo = $this->pdoService->query("SELECT * FROM plugins WHERE name = '$name'");

        $this->name = $pdo[0]['name'];
        $this->description = $pdo[0]['description'];
        $this->author = $pdo[0]['author'];
        $this->date = $pdo[0]['date'];
        $this->versionPlugin = $pdo[0]['versionplugin'];
        $this->versionPluxml = $pdo[0]['versionpluxml'];
        $this->link = $pdo[0]['link'];
        $this->file = $pdo[0]['file'];
    }

    /**
     *
     * @param ContainerInterface $container
     * @param string $name
     * @return bool
     */
    public function delete(ContainerInterface $container, string $name)
    {
        return $this->pdoService->delete("DELETE FROM plugins WHERE name = '$name'");
    }
}