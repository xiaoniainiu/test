<?php


/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor
 * @Email: liuguangpingtest@163.com
 */

require_once 'DB.php';
require_once 'HtmlOutPut.php';
require_once 'CIModelGen.php';


class CIGen
{
	private $savePath;
	private $tables;	
	private $iOutPut;

	public function __construct($savePath)
	{
		if(!file_exists($savePath))
		{
			mkdir($savePath, 0777, true);
		}

		$this->savePath = $savePath;
		$this->iOutPut = new HtmlOutPut();

		$db = new DB();
		$this->tables = $db->GetTables(); 
	}

	public function version()
	{
		return '0.2';
	}

	public function SetOutPut($iOutPut)
	{
		$this->iOutPut = $iOutPut;
	}

	public function M()
	{
		$ciModelGen = new CIModelGen($this->tables, $this->savePath, $this->iOutPut);
		$ciModelGen->Gen();
		return $this;
	}

}

?>
