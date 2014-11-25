<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */
require_once 'CIGen.php';

/**
 * 如果取消了$ci->SetOutPut(new CmdOutPut())注释，也请取消该注释。
 */
//require_once 'CmdOutPut.php';

$saveDir = dirname(__FILE__).'/autocode/';

$ci = new CiGen($saveDir);

/**
 * 当在命令行下执行时，请设置日志的输出格式为 CMD。
 */
//$ci->SetOutPut(new CmdOutPut());

//$ci->M()->V()->C()->Admin();
$ci->M();
?>
