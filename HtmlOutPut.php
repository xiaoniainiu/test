<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */

require_once 'IOutPut.php';

class HtmlOutPut implements IOutPut
{
	public function WriteHeader($text='')
	{
		echo "<h1>$text</h1>";
	}

	public function WriteLine($text='')
	{
		echo $text.'<br/>';
	}
}

?>