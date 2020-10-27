<?php
/**
 * Model
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class Model
{

    private ContainerInterface $container;

    protected $pdoService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdoService = $this->container->get('pdo');
    }
}