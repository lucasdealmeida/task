<?php
namespace Questao3\Database;

use Exception;
use ReflectionClass;

class Connection{

	private static $connection = null;

	private static $config = null;

	static function getConnection(){
		if (is_null(self::$connection)){
			self::createDriverConnection();
		}
		return self::$connection;
	}

	static function createDriverConnection(){
		self::$connection = self::getDriver()->createConnection();
	}

	static function getDriver(){
		list($driver, $host, $schema, $username, $password) = self::getConfig();
		if (file_exists(self::getDriverFile($driver))){
			$driverReflection = new ReflectionClass(self::getDriverClassWithNamespace($driver));
			$driver = $driverReflection->newInstance($host, $schema, $username, $password);
			return $driver;
		}else{
			throw new Exception('Driver inválido.');
		}	
	}

	static function getConfig(){
		if (!is_null(self::$config)){
			return self::$config;
		}
		throw new Exception('Não foi informado o arquivo de configuração.');
	}

	static function setConfig($config_file){
		self::$config = self::parseConfigFile($config_file);
	}

	private static function parseConfigFile($config_file){
		if (file_exists($config_file)){
			$parse = parse_ini_file($config_file); 
			if (!isset($parse['driver'])){
				throw new Exception('Driver não foi definido no arquivo de configuração.');
			}elseif (!isset($parse['host'])){
				throw new Exception('Host não foi definido no arquivo de configuração.');
			}elseif (!isset($parse['schema'])){
				throw new Exception('Schema não foi definido no arquivo de configuração.');
			}elseif (!isset($parse['username'])){
				throw new Exception('Username não foi definido no arquivo de configuração.');
			}elseif (!isset($parse['password'])){
				throw new Exception('Password não foi definido no arquivo de configuração.');				
			}
			return [
				$parse['driver'],
				$parse['host'],
				$parse['schema'],
				$parse['username'],
				$parse['password']
			];
		}
		throw new Exception('Não foi encontrado o arquivo de configuração.');
	}

	private static function getDriverClassWithNamespace($driver){
		return __NAMESPACE__ . '\\' . self::getDriverName($driver);
	}
	private static function getDriverFile($driver){
		return dirname(__FILE__) . DIRECTORY_SEPARATOR . self::getDriverName($driver) . '.php';
	}
	private static function getDriverName($driver){
		return ucfirst(strtolower($driver));
	}
}