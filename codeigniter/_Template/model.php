<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At {_datetime_} 
 * liuguangpingAuthor: 刘广平
 * Email: liuguangpingtest@163.com
 */
class {_classname_} extends MY_Model
{
	{_fields_}

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	{_m_get_by_primary_key_}

	

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('{_tablename_}');
	}

	

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($_POST)
	{
		{_validation_content_by_insert_}

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($_POST)
	{
		{_validation_content_by_update_}

		return true;
	}

	{_m_delete_by_primary_key_}
}
