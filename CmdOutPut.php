<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */

require_once 'IOutPut.php';

class CmdOutPut implements IOutPut
{
	public function WriteHeader($tex='')
	{
		echo "\r\n**** $text ****\r\n";
	}

	public function WriteLine($text='')
	{
		echo $text."\r\n";
	}
}

?>