<?php
namespace Questao3;

class MySqlDataBase extends AbstractDataBaseFactory{
    public function getConnection(){
        return sprintf('mysql:host=%s;dbname=%s',
            $this->getHost(),
            $this->getDbname()
        );
    }
}