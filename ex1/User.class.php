<?php
class User {
	private $is_debug = true;
	private $id = null;
	private $name = null;
	private $email = null;

	/**
	*__call
	*input:
	*		$method:String,call method name
	*		$paramas:array,even if you only have one param,it will send to this function with array
	*output:
	*		subfunction returnd
	*/
	function __call($method, $params){

		if(preg_match("/get(.*)/i",$method,$preg))
			return $this->getFiled(strtolower($preg[1]));
		elseif(preg_match("/set(.*)/i",$method,$preg))
			return $this->setFiled(strtolower($preg[1]),$params[0]);
		elseif(preg_match("/findBy(.*)/i",$method,$preg))
			return $this->findFiled(strtolower($preg[1]),$params[0]);
	}

	/**
	*getFiled,
	*input:
	*		$filed:String,yout want to get class param name
	*output:
	*		class param value
	*/
	private function getFiled($filed){
		return $this->$filed;
	}

	/**
	*setFiled,
	*input:
	*		$filed:String,yout want to get class param name
	*		$value:String
	*output:
	*		null
	*/
	private function setFiled($filed,$value){
		$this->$filed = $value;		
	}

	private function findFiled($filed){
		echo 'find by filed '.$filed;
	}

	/**
	*__get,call when you want to get class param don't have
	*input:
	*		$name:String,yout want to get class param name
	*		
	*output:
	*		null.even you wirte return boolean
	*/
	function __get($name){
		if($is_debug)
			echo 'Your val is '.$name.',and is not exsit in this class!';
	}

	/**
	*__set,call when you want to set class param don't have
	*input:
	*		$name:String,yout want to get class param name
	*		$value:String
	*		
	*output:
	*		null.even you wirte return boolean
	*/
	function __set($name,$value){
		if($is_debug)
			echo 'Your val is '.$name.'=>'.$value;
	}


}