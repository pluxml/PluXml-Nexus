<?php
/**
 * UserModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class CategoryModel extends Model
{

    public $id;

    public $name;

    public $icon;

    public function __construct(ContainerInterface $container, int $id)
    {
        parent::__construct($container);

        $pdo = $this->pdoService->query("SELECT * FROM categories WHERE id = '$id'");

        $this->id = $pdo[0]['id'];
        $this->name = $pdo[0]['name'];
        $this->icon = $pdo[0]['icon'];
    }
}