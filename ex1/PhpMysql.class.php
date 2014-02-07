<?php
include 'db.config.php';

class PhpMysql{

	private $db_link = NULL;
	private $db_host = 'localhost';
	private $db_user_name = 'root';
	private $db_password = '123456';
	private $db_name = '';

	private $is_log = '';



	public function __construct($DBConfig){

		if ($DBConfig['DB_HOST']!=null){
			$this->db_host = $DBConfig['DB_HOST'];
		}

		if ($DBConfig['DB_USER']!=null){
			$this->db_user_name = $DBConfig['DB_USER'];
		}

		if ($DBConfig['DB_PASSWORD']!=null){
			$this->db_password = $DBConfig['DB_PASSWORD'];
		}

		if($DBConfig['DB_NAME']!=null){
			$this->db_name = $DBConfig['DB_NAME'];
		}

		if($DBConfig['IS_LOG']!=null){
			$this->is_log = $DBConfig['IS_LOG'];
		}

		$this->connect();				
	}

	/**
	*db connect function and call select database function,
	*don't have any result,if has error die
	*/
	private function connect(){
		$this->db_link = mysql_pconnect($this->db_host, $this->db_user_name, $this->db_password);

		if ($this->db_link == NULL){
			die('database connect error');
		}

		$this->select_db();
	}

	/**
	*select databse 
	*/
	private function select_db(){

		if(!mysql_select_db($this->db_name, $this->db_link)){
			die("can't select database");
		}

	}

	/**
	*log error message
	*/
	private function logError(){
		if ($this->is_log){
			die("Invalid query: " . mysql_error());
		}
	}

	/**
	*free result
	*/
	private function free(){
		mysql_free_result($this->result);
	}

	/**
	*destruct function,free result and close database link
	*/
	public function __destruct() {

		if (!empty ($this->result)) {
			$this->free();
		}

		if($this->db_link!=null)
			mysql_close($this->db_link);
	}

	/**
	* function getBy,to select information frome table by table name and colume
	*input:
	*		$colume:array with colume_name and colume_value,as selct condition
	*		$select:array only has colume_name as you wan't select data,if only 
	*				has one colum to select,can use string
	*output:
	*		$array_result:array with select result,if not or error,return null
	*/
	public function getBy($table,$colume,$select = null){

		if($select == null){
			$sql = 'SELECT * FROM '.$table.' where ';
		}elseif(is_array($select)){
			$select_str = implode(',', $select);
			$sql = 'SELECT '.$select_str.' FROM '.$table.' where ';
		}else{
			$sql = 'SELECT '.$select.' FROM '.$table.' where ';
		}
		
		foreach ($colume as $colume_name => $value) {
			$sql .= $colume_name.'=`'.$value'`,';
		}

		$sql = rtrim($sql,',');

		if(query_sql($sql)){
			$array_result = mysql_fetch_array($this->result);
			if(is_array($array_result) && count($array_result)>0){
				return $array_result;
			}else{
				return null;
			}
		}
	}	

	/**
	*query_sql
	*input:
	*		$sql:String
	*output:
	*		boolean,if don't has error,return true otherwidse return false
	*/
	public function query_sql($sql){
		$this->result = mysql_query($sql);
		if($this->result == false){
			$this->logError();
			return false;
		}else{
			return true;
		}
	}

	/**
	*insert,insert array data to table
	*input:
	*		$table:String,table name
	*		$data:array,colume name as key
	*output:
	*		insert_id,int,if insert error,return null
	*/
	public function insert($table,$data){
		$keys = implode(',',array_keys($data));
		$values = implode(',',array_values($data));
		$sql = 'INSERT INTO '.$table.'('.$keys.') VALUES ('.$values.')';
		if(query_sql($sql)){
			return mysql_insert_id($this->db_link);
		}else{
			return null;
		}
	}

	/**
	*update,update array data to table
	*input:
	*		$table:String,table name
	*		$data:array,colume name as key,has key id as update condition
	*output:
	*		boolean,if update error return false, otherwidse return true
	*/
	public function update($table,$data){
		$sql = 'UPDATE '.$table.' SET ';
		if(array_key_exists('id', $data)){
			$where = 'id = `'.$data['id'].'`';
			foreach ($data as $key => $value) {
				$sql .= $key.'=`'.$valuse.'`,'
			}
			$sql = rtrim($sql,',');
			$sql = $sql.' '.$where;
			if(query_sql($sql)){
				if(mysql_affected_rows()){
					return true;
				}
			}
		}
		return false;
	}

}
?>