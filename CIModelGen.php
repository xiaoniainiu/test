<?php
/**
 * Copyright (C) "Code Generator Tools"
 * @author liuguangpingAuthor liuguangpingtest@163.com
 */

require_once 'DB.php';
require_once 'GenHelp.php';

/**
 * CI模型生成类
 */
class CIModelGen
{
	private $tables;
	private $savePath;
	private $iOutPut;

	public function __construct($tables, $saveBase, $iOutPut)
	{
		$this->tables = $tables;
		$this->savePath = $saveBase.'models/';
		$this->iOutPut = $iOutPut;

		if(!file_exists($this->savePath))
		{
			mkdir($this->savePath, 0777, true);
		}
	}

	public function Gen()
	{ 
		if(empty($this->tables))
		{
			$this->iOutPut->WriteLine('No Tables');
			return;
		}

		$this->iOutPut->WriteHeader('Models('.count($this->tables).')');

		header("Content-type:text/html;charset=utf-8");

		foreach($this->tables as $table)
		{
			$tablename = $table['TABLE_NAME'];
			$filename = $this->savePath.strtolower($tablename).'_model.php';
			$result = $this->GenModel($tablename, $filename);
			
			$gen_state_str = ($result)?'OK':'Fail';
			$file_save_datetime = GenHelp::ZhDate();
			$this->iOutPut->WriteLine("generator ".$gen_state_str." $filename (".filesize($filename)." Byte) -- $file_save_datetime");
		}

		$this->iOutPut->WriteLine("<a href='/killbom.php'>去除BOM头</a>");
	}

	private function GenModel($tablename, $filename)
	{
		$db = new DB();

		$classname = ucfirst(strtolower($tablename));		
		$columns = $db->GetTableColumns($tablename);

		//读取模板文件到字符串变量 $model_str 中
		$model_template_file = dirname(__FILE__).'/codeigniter/_Template/model.php';
		$model_str = file_get_contents($model_template_file);

		/*
		 * 替换模板文件中的标记
		 * 
		 * {_datetime_}
		 * {_classname_}
		 * {_tablename_}
		 * {_fields_}
		 * {_m_get_by_primary_key_}
		 * {_m_delete_by_primary_key_}
		 * {_insert_content_}
		 * {_update_content_}
		 * {_update_where_}
		 * {_validation_content_by_update_}
		 * {_validation_content_by_insert_}
		 * {_important_primary_key_name_}
		 *
		 */
		$model_new_str = $model_str;
		$model_new_str = str_replace('{_datetime_}', GenHelp::ZhDate(), $model_new_str);
		$model_new_str = str_replace('{_classname_}', ucfirst($tablename).'_model', $model_new_str);
		$model_new_str = str_replace('{_tablename_}', $tablename, $model_new_str);

		// 替换 {_fields_}
		$field_str = $this->CreateModelFields($columns);
		$model_new_str = str_replace('{_fields_}', $field_str, $model_new_str);

		// 替换 {_m_get_by_primary_key_}
		$m_get_by_primary_key_str = $this->CreateGetMethodByPrimaryKey($tablename, $columns);
		$model_new_str = str_replace('{_m_get_by_primary_key_}', $m_get_by_primary_key_str, $model_new_str);

		// 替换 {_m_delete_by_primary_key_}
		$m_delete_by_primary_key_str = $this->CreateDeleteMethodByPrimaryKey($tablename, $columns);
		$model_new_str = str_replace('{_m_delete_by_primary_key_}', $m_delete_by_primary_key_str, $model_new_str);

		// 替换 {_insert_content_}
		$insert_content_str = $this->CreateInsertContent($columns);
		$model_new_str = str_replace('{_insert_content_}', $insert_content_str, $model_new_str);

		// 替换 {_update_content_}
		$update_content_str = $this->CreateUpdateContent($columns);
		$model_new_str = str_replace('{_update_content_}', $update_content_str, $model_new_str);

		// 替换 {_update_where_}
		$update_where_str = $this->CreateUpdateWhereExpressionByPrimaryKey(GenHelp::GetPrimaryKeyColumns($columns));
		$model_new_str = str_replace('{_update_where_}', $update_where_str, $model_new_str);

		// 替换 {_validation_content_by_insert_}
		$validation_content_by_insert_str = $this->CreateValidationContentByInsert(GenHelp::GetIsNotNullableColumns($columns));
		$model_new_str = str_replace('{_validation_content_by_insert_}', $validation_content_by_insert_str, $model_new_str);

		// 替换 {_validation_content_by_update_}
		$validation_content_by_update_str = $this->CreateValidationContentByUpdate(GenHelp::GetIsNotNullableColumns($columns));
		$model_new_str = str_replace('{_validation_content_by_update_}', $validation_content_by_update_str, $model_new_str);

		// 替换 {_important_primary_key_name_}
		$important_primary_key_name_str = GenHelp::GetImportantPrimaryKeyName($columns);
		$model_new_str = str_replace('{_important_primary_key_name_}', $important_primary_key_name_str, $model_new_str);

		//保存替换后的字符串到文件 $filename
		return file_put_contents($filename, $model_new_str);
	}

	private function CreateModelFields($columns)
	{
		$result='';
		foreach($columns as $column)
		{
			$result .= '/**'."\r\n\t";
			$result .= ' * @COLUMN_KEY		'.$column['COLUMN_KEY']."\r\n\t";
			$result .= ' * @DATA_TYPE		'.$column['DATA_TYPE']."\r\n\t";
			$result .= ' * @IS_NULLABLE		'.$column['IS_NULLABLE']."\r\n\t";
			$result .= ' * @COLUMN_DEFAULT	'.$column['COLUMN_DEFAULT']."\r\n\t";
			$result .= ' * @COLUMN_TYPE		'.$column['COLUMN_TYPE']."\r\n\t";
			$result .= ' * @EXTRA			'.$column['EXTRA']."\r\n\t";
			$result .= ' * @COLUMN_COMMENT	'.$column['COLUMN_COMMENT']."\r\n\t";
			$result .= ' */'."\r\n\t";
			$result .= 'public $'.$column['COLUMN_NAME'].";\r\n\r\n\t";
		}
		$result = substr($result, 0, strlen($result) - 5);
		return $result;
	}

	/*
	 * 考虑到主键可能不只一个，故函数的实现需要动态的根据主键的数量进行函数的参数匹配以及SQL查询条件的匹配
	 * create_m_delete_by_primary_key 也一样
	 */
	private function CreateGetMethodByPrimaryKey($tablename, $columns)
	{
		$result = '/**'."\r\n\t";
		$result .= ' * 根据主键获取单条记录'."\r\n\t";
		$result .= ' *'."\r\n\t";
		$primary_key_columns = GenHelp::GetPrimaryKeyColumns($columns);
		foreach($primary_key_columns as $primary_key_column)
		{
			$result .= ' * @PRIMARY KEY '.$primary_key_column['COLUMN_NAME']."\r\n\t";
		}
		$result .= ' *'."\r\n\t";
		$result .= ' * @return 对象'."\r\n\t";
		$result .= "*/\r\n\t";
		$func_param = GenHelp::CreateFunctionParamsByPrimaryKey($primary_key_columns);
		$result .= 'public function get('.$func_param.')'."\r\n\t";
		$result .= '{'."\r\n\t";
		$array_where = $this->CreateWhereExpressionByPrimaryKey($primary_key_columns);
		$result .= '	return $this->db->get_where('."'".$tablename."'".','.$array_where.')->row();'."\r\n\t";
		$result .= '}'."\r\n\t";
		return $result;
	}

	private function CreateDeleteMethodByPrimaryKey($tablename, $columns)
	{
		$result = '/**'."\r\n\t";
		$result .= ' * 根据主键删除单条记录'."\r\n\t";
		$result .= ' *'."\r\n\t";
		$primary_key_columns = GenHelp::GetPrimaryKeyColumns($columns);
		foreach($primary_key_columns as $primary_key_column)
		{
			$result .= ' * @PRIMARY KEY '.$primary_key_column['COLUMN_NAME']."\r\n\t";
		}
		$result .= "*/\r\n\t";
		$func_param = GenHelp::CreateFunctionParamsByPrimaryKey($primary_key_columns);
		$result .= 'public function delete('.$func_param.')'."\r\n\t";
		$result .= '{'."\r\n\t";
		$array_where = $this->CreateWhereExpressionByPrimaryKey($primary_key_columns);
		$result .= '	return $this->db->delete('."'".$tablename."'".','.$array_where.');'."\r\n\t";
		$result .= '}'."\r\n\t";
		return $result;
	}

	//根据主键生成函数(get(), delete())体内SQL语句中的where表达式
	private function CreateWhereExpressionByPrimaryKey($primary_key_columns)
	{
		$result = 'array(';
		foreach($primary_key_columns as $column)
		{
			$result .= "'".$column['COLUMN_NAME']."' => ".'$'.$column['COLUMN_NAME'].',';
		}
		$result = substr($result, 0, strlen($result) - 1);
		$result .= ')';
		return $result;
	}

	//根据主键生成函数(update())体内SQL语句中的where表达式
	private function CreateUpdateWhereExpressionByPrimaryKey($primary_key_columns)
	{
		$result = 'array(';
		foreach($primary_key_columns as $column)
		{
			$result .= "'".$column['COLUMN_NAME']."' => ".'$post['."'".$column['COLUMN_NAME']."'".'],';
		}
		$result = substr($result, 0, strlen($result) - 1);
		$result .= ')';
		return $result;
	}

	//生成函数 insert() 中的赋值语句
	private function CreateInsertContent($columns)
	{
		return $this->CreateInsertORUpdateContent($columns);
	}

	//生成函数 update() 中的赋值语句
	private function CreateUpdateContent($columns)
	{
		return $this->CreateInsertORUpdateContent($columns);
	}

	private function CreateInsertORUpdateContent($columns)
	{
		$result='';
		foreach($columns as $column)
		{
			/*if($column['COLUMN_KEY'] == 'PRI')
			{
				$result .= '//';
			}*/
			$result .= '$this->'.$column['COLUMN_NAME'].' = isset($post['."'".$column['COLUMN_NAME']."'".'])? $post['."'".$column['COLUMN_NAME']."'".'] : $this->'.$column['COLUMN_NAME'].';'."\r\n\t\t";
		}
		return $result;
	}

	private function CreateValidationContentByInsert($is_not_nullable_columns)
	{
		$result='';
		foreach($is_not_nullable_columns as $columns)
		{
			if($columns['COLUMN_KEY'] == 'PRI')
				continue;
			$result .= 'if(!isset($post['."'".$columns['COLUMN_NAME']."'".']) || empty($post['."'".$columns['COLUMN_NAME']."'".'])) return false;'."\r\n\t\t";
		}
		$result = substr($result, 0, strlen($result) - 4);
		return $result;
	}

	private function CreateValidationContentByUpdate($is_not_nullable_columns)
	{
		$result='';
		foreach($is_not_nullable_columns as $columns)
		{
			$result .= 'if(!isset($post['."'".$columns['COLUMN_NAME']."'".']) || empty($post['."'".$columns['COLUMN_NAME']."'".'])) return false;'."\r\n\t\t";
		}
		$result = substr($result, 0, strlen($result) - 4);
		return $result;
	}
}

?>