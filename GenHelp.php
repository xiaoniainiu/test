<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */

class GenHelp
{
	public static function ZhDate()
	{
		date_default_timezone_set('Asia/Shanghai');
		return date("Y/m/d H:i:s");
	}

	//返回是主键的列记录
	public static function GetPrimaryKeyColumns($columns)
	{
		$result = array();
		foreach($columns as $column)
		{
			if($column['COLUMN_KEY'] == 'PRI')
			{
				$result[] = $column;
			}
		}
		return $result;
	}

	/**
	 * 返回主键列表中相对重要的一个主键列
	 *
	 * 如果主键列表中存在自动增长的，则返回自动增长的那一列，否则就返回主键列表中的第一列
	 */
	public static function GetImportantPrimaryKey($columns)
	{
		$primary_key_columns = GenHelp::GetPrimaryKeyColumns($columns);
		foreach($primary_key_columns as $column)
		{
			if($column['EXTRA'] == 'auto_increment')
			{
				return $column;
			}
		}
		return $primary_key_columns[0];
	}

	//返回主键列第一个主键记录
	public static function GetImportantPrimaryKeyName($columns)
	{
		$column = GenHelp::GetImportantPrimaryKey($columns);
		return $column['COLUMN_NAME'];
	}

	//返回不能为空的列记录
	public static function GetIsNotNullableColumns($columns)
	{
		$result = array();
		foreach($columns as $column)
		{
			if($column['IS_NULLABLE'] == 'NO')
			{
				$result[] = $column;
			}
		}
		return $result;
	}

	//根据主键生成函数的参数，例如 (get(), delete())
	public static function CreateFunctionParamsByPrimaryKey($primary_key_columns)
	{
		$result='';
		foreach($primary_key_columns as $column)
		{
			$result .= '$'.$column['COLUMN_NAME'].', ';
		}
		$result = substr($result, 0, strlen($result) - 2);
		return $result;
	}

	//生成验证 CreateFunctionParamsByPrimaryKey 中的参数是否为空的PHP语句
	public function CreateEmptyCheckFunctionParamsByPrimaryKey($primary_key_columns)
	{
		$result = 'if(';
		foreach($primary_key_columns as $column)
		{
			$result .= 'empty($'.$column['COLUMN_NAME'].') || ';
		}
		$result = substr($result, 0, strlen($result) - 4);
		$result .= ') { return; }'."\r\n";
		return $result;
	}
}

?>