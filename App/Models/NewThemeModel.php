<?php
/**
 * NewThemeModel
 */
namespace App\Models;

use App\Facades\UsersFacade;
use Psr\Container\ContainerInterface;

class NewThemeModel extends Model
{

    private $name;

    private $description;

    private $author;

    private $date;

    private $versionTheme;

    private $versionPluxml;

    private $link;

    private string $file;

    private $image;

    public function __construct(ContainerInterface $container, array $theme)
    {
        parent::__construct($container);

        $userModel = UsersFacade::searchUser($container, $theme['author']);

        $this->name = $theme['name'];
        $this->description = $theme['description'] ?? null;
        $this->author = $userModel ? $userModel->id : null;
        $this->date = date('Y-m-d');
        $this->versionTheme = $theme['versionTheme'] ?? null;
        $this->versionPluxml = $theme['versionPluxml'] ?? null;
        $this->link = $theme['link'] ?? null;
        $this->file = DIR_THEMES . DIRECTORY_SEPARATOR . $theme['name'] . '.zip';
        $this->image = $theme['image'] ?? null;
    }

    /**
     *
     * @return bool
     */
    public function saveNewTheme()
    {
        return $this->pdoService->insert(
            'INSERT INTO themes SET name = :name, description = :description, author = :author, date = :date, versiontheme = :versionTheme, versionpluxml = :versionPluxml, link = :link, file = :file, image = :image',
            $this->toParams()
        );
    }

    /**
     *
     * @return bool
     */
    public function updateTheme()
    {
        return $this->pdoService->insert(
            'UPDATE themes SET description = :description, author = :author, date = :date, versiontheme = :versionTheme, versionpluxml = :versionPluxml, link = :link, file = :file, image = :image WHERE name = :name',
            $this->toParams()
        );
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
            'versionTheme' => $this->versionTheme,
            'versionPluxml' => $this->versionPluxml,
            'link' => $this->link,
            'file' => $this->file,
            'image' => $this->image,
        ];
    }
}
