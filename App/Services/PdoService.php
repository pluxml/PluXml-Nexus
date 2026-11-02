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
     * @param Array $params values bound to the placeholders of $sql
     * @return Array
     */
    public function query(String $sql, Array $params = [])
    {
        $req = $this->pdo->prepare($sql);
        $req->execute($params);
        return $req->fetchAll();
    }

    /**
     *
     * @param String $sql
     * @param Array $params values bound to the placeholders of $sql
     * @return Bool
     */
    public function insert(String $sql, Array $params = [])
    {
        $req = $this->pdo->prepare($sql);
        return $req->execute($params);
    }

    /**
     *
     * @param String $sql
     * @param Array $params values bound to the placeholders of $sql
     * @return Bool
     */
    public function delete(String $sql, Array $params = [])
    {
        $req = $this->pdo->prepare($sql);
        return $req->execute($params);
    }
}