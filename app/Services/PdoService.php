<?php
/**
 * PdoService
 */
namespace App\Services;

class PdoService
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DBNAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     *
     * @param String $sql
     * @return Array
     */
    public function query(String $sql)
    {
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     *
     * @param String $sql
     * @return Bool
     */
    public function insert(String $sql)
    {
        $req = $this->pdo->prepare($sql);
        return $req->execute();
    }
}