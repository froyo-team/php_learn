<?php

class ApiKey{
	/**
	*function getRandmCharAndNum can return randm key has char and number
	*input:None,
	*output:String,$rand
	**/
	public function getRandmCharAndNum($length = 8){

		$base_char= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		srand((double)microtime()*1000000);
		for($i=0; $i<$length; $i++) {
			$rand.= $base_char[rand()%strlen($base_char)];
		}
		return $rand;
	}

	/**
	*function createApiKey creat an randm apikey with time
	*input:None,
	*output:String,$token
	**/
	public function createApiKey(){
        $token_tmp = $this->getRandmCharAndNum(12);
        $timestamp = time();
        $tmpArr = array($token_tmp, $timestamp);
        sort($tmpArr);
        $token = str_shuffle(implode( $tmpArr ));
        return $token;        
	}

	/**
	*function checkApiKey check api key with input
	*input:,
	*		$toke:String,
	*		$timestamp:String,
	*		$once:String,
	*		$signature:String
	*output:
	*		boolean, if $signature == sha1($tmpStr) return true,otherwise return false
	**/
	public function checkApiKey($token,$timestamp,$once,$signature){
		if($token!=null && $timestamp!=null && $once!=null && $signature!=null){
			$tmpArr = array($token,$timestamp,$once);
	        sort($tmpArr);
	        $tmpStr = implode( $tmpArr );
	        $tmpStr = sha1($tmpStr);

	        if($tmpStr == $signature){
	        	return true;
	        }

		}

		return false;		
	}
}
?>