<?php
/**
 * NewPluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class NewPluginModel extends Model
{

    private $name;

    private $description;

    private $author;

    private $date;

    private $versionPlugin;

    private $versionPluxml;

    private $link;

    private $file;

    public function __construct(ContainerInterface $container, Array $plugin)
    {
        parent::__construct($container);

        $this->name = $plugin['name'];
        $this->description = $plugin['description'];
        $this->author = $plugin['author'];
        $this->date = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $this->versionPlugin = $plugin['versionplugin'];
        $this->versionPluxml = $plugin['versionpluxml'];
        $this->link = $plugin['link'];
        $this->file = $plugin['file'];
    }

    /**
     *
     * @return Bool
     */
    public function saveNewUser()
    {
        return $this->pdoService->insert("INSERT INTO users SET name = '$this->name', description = '$this->description', author = '$this->author', date = '$this->date', versionPlugin = '$this->versionPlugin', versionPluxml = '$this->versionPluxml', link = '$this->link', file= '$this->file'");
    }
}