<?php
/**
 * Model
 */
namespace App\Models;

use Psr\Container\ContainerInterface;

class Model
{

    private $container;

    protected $pdoService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdoService = $this->container->get('pdo');
    }

    /**
     *
     * @param String $sql
     * @return Array
     */
    protected function query(String $sql)
    {
        $req = $this->pdoService->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}