<?php
namespace Questao1;

class Multiple{
	
	private $rules = [];

	private $max = 100;

	public function isMultiple($number, $multiple){
		return ($number % $multiple == 0) ? true : false;
	}

	public function setRules($rules){
		$this->rules = $rules;
	}

	public function setMax($max){
		$this->max = $max;
	}

	public function checkMultiples(){
		$return = [];
		for ($i = 1; $i <= $this->max; $i++){
			$result = [];
			foreach ($this->rules as $multiple => $message){
				if ($this->isMultiple($i, $multiple)){
					$result[] = $message;
				}
			}
			if (!count($result)){
				$result[] = $i;
			}
			$return[] = implode($result);
		}
		return $return;
	}
}