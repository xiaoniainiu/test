<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/11/10 09:05:00 
 * liuguangpingAuthor: 刘广平
 * Email: liuguangpingtest@163.com
 */
class T_role_model extends MY_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $rid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(36)
	 * @EXTRA			
	 * @COLUMN_COMMENT	?????
	 */
	public $title;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(36)
	 * @EXTRA			
	 * @COLUMN_COMMENT	???????
	 */
	public $entitle;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $ctime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(120)
	 * @EXTRA			
	 * @COLUMN_COMMENT	?????
	 */
	public $ico;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	-1??? 0??1???2???
	 */
	public $state;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY rid
	 *
	 * @return 对象
	*/
	public function get($rid)
	{
		return $this->db->get_where('t_role',array('rid' => $rid))->row();
	}
	

	

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_role');
	}

	

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($_POST)
	{
		if(!isset($post['ctime']) || empty($post['ctime'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($_POST)
	{
		if(!isset($post['rid']) || empty($post['rid'])) return false;
		if(!isset($post['ctime']) || empty($post['ctime'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY rid
	*/
	public function delete($rid)
	{
		return $this->db->delete('t_role',array('rid' => $rid));
	}
	
}
