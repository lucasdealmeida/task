<?php
namespace Questao1;

require '../vendor/autoload.php';

use Questao1\Multiple;

$multiple = new Multiple();
$multiple->setMax(100);
$multiple->setRules([
	3 => 'Fizz',
	5 => 'Buzz'
]);
$output = $multiple->checkMultiples();
echo implode('<br>', $output);