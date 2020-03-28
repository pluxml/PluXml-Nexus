<?php
/**
 * Model
 */
namespace App\Models;

class TestModel extends Model
{

    public $test;
    
    public function __construct($container)
    {
        parent::__construct($container);
        $this->test = $this->pdoService->query('select * from test');
    }
}