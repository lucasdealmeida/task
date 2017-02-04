<?php
namespace Questao3\Database;

use PDO;

class Mysql extends DataBaseFactory {
    public function createConnection(){
        return new PDO(
    		'mysql:host='. $this->getHost() .';dbname='.$this->getSchema(),
    		$this->getUsername(),
    		$this->getPassword(),
    		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
		);
    }
}