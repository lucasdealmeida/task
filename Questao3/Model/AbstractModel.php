<?php
namespace Questao3\Model;

use Questao3\Database\Connection;

abstract class AbstractModel{
    
    public $connection = null;

    public function __construct($connection = null){
        if (is_null($connection)){
            $this->connection = Connection::getConnection();
        }
    }

    public function all($orderBy = ['column' => 'id', 'direction' => 'ASC']){
        $sth = $this->connection->prepare('select * from '.$this->table.' order by :order_column :order_direction');
        $sth->execute([
            ':order_column' => $orderBy['column'], 
            ':order_direction' => $orderBy['direction']
        ]);
        return $sth->fetchAll();
    }

}