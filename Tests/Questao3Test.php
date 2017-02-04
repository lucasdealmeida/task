<?php

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Questao3\Database\Connection;

class Questao3Test extends TestCase
{

    private $config;

    public function setUp(){
        $this->config = vfsStream::newFile('config.ini')->at(vfsStream::setup('Questao3'));
    }

    public function testMysqlDriver(){
        $config = $this->config->setContent('
            driver = mysql
            host = 127.0.0.1
            schema = teste
            username = root
            password = root
        ');
        Connection::setConfig($config->url());
        $driverClass = Connection::getDriver();

        $this->assertInstanceOf("Questao3\Database\Mysql", $driverClass);
    }

    public function testConnection(){
        $config = $this->config->setContent('
            driver = mysql
            host = 127.0.0.1
            schema = teste
            username = root
            password = root
        ');
        Connection::setConfig($config->url());
        $driverClass = Connection::getConnection();

        $this->assertInstanceOf("PDO", $driverClass);
    }

    public function testConfigDriverUndefined(){
        $this->expectExceptionMessage('Driver não foi definido no arquivo de configuração.');
        $config = $this->config->setContent('');
        Connection::setConfig($config->url());
    }

    public function testConfigHostUndefined(){
        $this->expectExceptionMessage('Host não foi definido no arquivo de configuração.');
        $config = $this->config->setContent('
            driver = mysql
        ');
        Connection::setConfig($config->url());
    }

    public function testConfigSchemaUndefined(){
        $this->expectExceptionMessage('Schema não foi definido no arquivo de configuração.');
        $config = $this->config->setContent('
            driver = mysql
            host = 127.0.0.1
        ');
        Connection::setConfig($config->url());
    }

    public function testConfigUsernameUndefined(){
        $this->expectExceptionMessage('Username não foi definido no arquivo de configuração.');
        $config = $this->config->setContent('
            driver = mysql
            host = 127.0.0.1
            schema = teste
        ');
        Connection::setConfig($config->url());
    }

    public function testConfigPasswordUndefined(){
        $this->expectExceptionMessage('Password não foi definido no arquivo de configuração.');
        $config = $this->config->setContent('
            driver = mysql
            host = 127.0.0.1
            schema = teste
            username = root
        ');
        Connection::setConfig($config->url());
    }

    public function testConfigDriverInvalid(){
        $this->expectExceptionMessage('Driver inválido.');
        $config = $this->config->setContent('
            driver = mysqlll
            host = 127.0.0.1
            schema = teste
            username = root
            password = root
        ');
        Connection::setConfig($config->url());
        Connection::getDriver();
    }

    public function testConfigInvalid(){
        $this->expectExceptionMessage('Não foi encontrado o arquivo de configuração.');
        Connection::setConfig('');
    }
}
?>