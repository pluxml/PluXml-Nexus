<?php
/**
 * NewPluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;
use App\Facades\UsersFacade;

class NewPluginModel extends Model
{

    public $name;

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

        $UserModel = UsersFacade::searchUser($container, $plugin['author']);

        $this->name = $plugin['name'];
        $this->description = $plugin['description'];
        $this->author = $UserModel->id; 
        $this->date = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $this->versionPlugin = $plugin['versionPlugin'];
        $this->versionPluxml = $plugin['versionPluxml'];
        $this->link = $plugin['link'];
        $this->file = $plugin['file'];
    }

    /**
     *
     * @return Bool
     */
    public function saveNewPlugin()
    {
        return $this->pdoService->insert("INSERT INTO plugins SET name = '$this->name', description = '$this->description', author = '$this->author', date = '$this->date', versionPlugin = '$this->versionPlugin', versionPluxml = '$this->versionPluxml', link = '$this->link', file= '$this->file'");
    }

    /**
     *
     * @return Bool
     */
    public function updatePlugin()
    {
        //echo "UPDATE plugins SET description = '$this->description', author = '$this->author', date = '$this->date', versionPlugin = '$this->versionPlugin', versionPluxml = '$this->versionPluxml', link = '$this->link', file= '$this->file' WHERE name = '$this->name'";
        return $this->pdoService->insert("UPDATE plugins SET description = '$this->description', author = '$this->author', date = '$this->date', versionPlugin = '$this->versionPlugin', versionPluxml = '$this->versionPluxml', link = '$this->link', file= '$this->file' WHERE name = '$this->name'");
    }
}