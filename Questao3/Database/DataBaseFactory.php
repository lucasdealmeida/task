<?php
namespace Questao3\Database;

abstract class DataBaseFactory { 

	protected $host;

	protected $schema;

	protected $username;

	protected $password;

    public function __construct($host, $schema, $username, $password){
        $this->host = $host;
        $this->schema = $schema;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(){
    	return $this->host;
    }

    public function getSchema(){
    	return $this->schema;
    }

    public function getUsername(){
    	return $this->username;
    }

    public function getPassword(){
    	return $this->password;
    }

    abstract public function createConnection();
}