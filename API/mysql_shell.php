<?php

class mySQL
{
	private $server = "localhost";
	private $username = "user";
	private $password = "password";
	private $database = "database";
	
	private $connection;
	
	function __construct()
	{
		$this->connection = mysql_connect($this->server,$this->username,$this->password,null,null);
		mysql_select_db($this->database,$this->connection);
	}
	
	//BAD BAD BAD BAD method. DO NOT USE!!!! You really really should be using parameterization, seeing as it makes things run faster... Not to mention this is done in a less then optimal way in order to provide flexiblity...
	function request($string)
	{
		$string = mysql_real_escape_string($string);
		$req = false;
		if($string)
			$req = mysql_query($string,$this->connection);
		$ret = mysql_fetch_assoc($req);
		return $ret;
	}
	
	function __destruct()
	{
		if(isset($this->connection))
			mysql_close(($this->connection));
	}
}


?>