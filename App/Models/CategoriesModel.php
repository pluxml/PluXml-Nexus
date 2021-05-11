<?php
/**
 * UserModel
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class CategoriesModel extends Model
{

    public $categories;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->categories = $this->pdoService->query('SELECT * FROM categories');
    }
}