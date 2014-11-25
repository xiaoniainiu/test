<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */

class DB
{
	private $host = 'localhost';
	private $user = 'root';
	private $password;
	private $charset = 'utf8';
	private $dbname = 'pd';

	private $target_db;	

	public function __construct()
	{
		$config = require(dirname(__FILE__).'/config/config.php');

		if(is_array($config) && count($config) > 0)
		{
			$this->host = isset($config['db_host'])? $config['db_host'] : $this->host;
			$this->user = isset($config['db_user'])? $config['db_user'] : $this->user;
			$this->password = isset($config['db_password'])? $config['db_password'] : $this->password;
			$this->charset = isset($config['db_charset'])? $config['db_charset'] : $this->charset;

			$this->target_db = isset($config['db_name'])? $config['db_name'] : $this->target_db;
		}
	}

	public function GetTables()
	{	
		$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$this->target_db'";
		return $this->query($sql);
	}

	public function GetTableColumns($tablename)
	{
		$sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$this->target_db' AND TABLE_NAME='$tablename' ORDER BY ORDINAL_POSITION ASC";
		return $this->query($sql);
	}

	private function query($sql)
	{
		$result = array();
		if(empty($sql)) return $result;

		$con = mysql_connect($this->host, $this->user, $this->password);
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}

		mysql_query("SET NAMES $this->charset", $con);

		mysql_select_db($this->dbname, $con);

		$queryResult = mysql_query($sql, $con);
		if(!$queryResult)
		{
			echo "Error query: " . mysql_error();
			return $result;
		}

        while($row = mysql_fetch_array($queryResult))
        {
            $result[] = $row;
        }
		mysql_close($con);
		return $result;
	}
}

?>
