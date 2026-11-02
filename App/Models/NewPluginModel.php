<?php
/**
 * NewPluginModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;
use App\Facades\UsersFacade;

class NewPluginModel extends Model
{

    private $name;

    private $description;

    private $author;

    private $date;

    private $versionPlugin;

    private $versionPluxml;

    private $link;

    private string $file;

    private int $category;

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
        $this->file = DIR_PLUGINS . DIRECTORY_SEPARATOR . $plugin['name'] . '.zip';
        $this->category = $plugin['category'];
    }

    /**
     *
     * @return bool
     */
    public function saveNewPlugin()
    {
        return $this->pdoService->insert('INSERT INTO plugins SET name = :name, description = :description, author = :author, date = :date, versionPlugin = :versionPlugin, versionPluxml = :versionPluxml, link = :link, file = :file, category = :category', $this->toParams());
    }

    /**
     *
     * @return bool
     */
    public function updatePlugin()
    {
        return $this->pdoService->insert('UPDATE plugins SET description = :description, author = :author, date = :date, versionPlugin = :versionPlugin, versionPluxml = :versionPluxml, link = :link, file = :file, category = :category WHERE name = :name', $this->toParams());
    }

    /**
     * Values bound to the placeholders of the INSERT and UPDATE queries
     *
     * @return array
     */
    private function toParams(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'date' => $this->date,
            'versionPlugin' => $this->versionPlugin,
            'versionPluxml' => $this->versionPluxml,
            'link' => $this->link,
            'file' => $this->file,
            'category' => $this->category,
        ];
    }
}