<?php
namespace Questao3;

require '../vendor/autoload.php';

use Questao3\Database\Connection;
use Questao3\Model\User;

try{
	Connection::setConfig('config.ini');
	$connection = Connection::getConnection();

	$user = new User();
	foreach($user->all() as $user){
		printf('ID: %u <br> Name: %s <br>' . str_repeat("-", 40) . '<br>', $user['id'], $user['name']);
	}


}catch(Exception $e){
	echo $e->getMessage();
}