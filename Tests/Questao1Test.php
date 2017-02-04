<?php

use PHPUnit\Framework\TestCase;
use Questao1\Multiple;

class Questao1Test extends TestCase
{
    public function testIsMultiple()
    {
        $multiple = new Multiple();
        $this->assertEquals(true, $multiple->isMultiple(3,3));
        $this->assertEquals(true, $multiple->isMultiple(6,3));

        $this->assertEquals(true, $multiple->isMultiple(5,5));
        $this->assertEquals(true, $multiple->isMultiple(10,5));

        $this->assertEquals(false, $multiple->isMultiple(2,3));
        $this->assertEquals(false, $multiple->isMultiple(3,5));
    }

    public function testCheckMultiples(){
    	$multiple = new Multiple();
    	$multiple->setMax(15);
    	$multiple->setRules([
    		3 => 'Fizz',
    		5 => 'Buzz'
    	]);
    	$result = $multiple->checkMultiples();
    	$expetedResult = [
    		'1',
			'2',
			'Fizz',
			'4',
			'Buzz',
			'Fizz',
			'7',
			'8',
			'Fizz',
			'Buzz',
			'11',
			'Fizz',
			'13',
			'14',
			'FizzBuzz'
    	];

    	$this->assertEquals($expetedResult, $result);
    }
}
?>