<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/11/10 09:05:00 
 * liuguangpingAuthor: 刘广平
 * Email: liuguangpingtest@163.com
 */
class T_system_user_model extends MY_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		mediumint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		mediumint(8) unsigned
	 * @EXTRA			auto_increment
	 * @COLUMN_COMMENT	??id
	 */
	public $uid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??list
	 */
	public $roles;

	/**
	 * @COLUMN_KEY		UNI
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	???
	 */
	public $username;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $realname;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(32)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??
	 */
	public $password;

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
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0000-00-00 00:00:00
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $logintime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(15)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??ip
	 */
	public $loginip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $auths;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	?????
	 */
	public $groups;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??: -1??? 0??1???2???
	 */
	public $state;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????????:0? 1??
	 */
	public $isadmin;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	2
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??1?0?
	 */
	public $sex;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY uid
	 *
	 * @return 对象
	*/
	public function get($uid)
	{
		return $this->db->get_where('t_system_user',array('uid' => $uid))->row();
	}
	

	

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system_user');
	}

	

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($_POST)
	{
		if(!isset($post['username']) || empty($post['username'])) return false;
		if(!isset($post['realname']) || empty($post['realname'])) return false;
		if(!isset($post['password']) || empty($post['password'])) return false;
		if(!isset($post['ctime']) || empty($post['ctime'])) return false;
		if(!isset($post['logintime']) || empty($post['logintime'])) return false;
		if(!isset($post['loginip']) || empty($post['loginip'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;
		if(!isset($post['isadmin']) || empty($post['isadmin'])) return false;
		if(!isset($post['sex']) || empty($post['sex'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($_POST)
	{
		if(!isset($post['uid']) || empty($post['uid'])) return false;
		if(!isset($post['username']) || empty($post['username'])) return false;
		if(!isset($post['realname']) || empty($post['realname'])) return false;
		if(!isset($post['password']) || empty($post['password'])) return false;
		if(!isset($post['ctime']) || empty($post['ctime'])) return false;
		if(!isset($post['logintime']) || empty($post['logintime'])) return false;
		if(!isset($post['loginip']) || empty($post['loginip'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;
		if(!isset($post['isadmin']) || empty($post['isadmin'])) return false;
		if(!isset($post['sex']) || empty($post['sex'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY uid
	*/
	public function delete($uid)
	{
		return $this->db->delete('t_system_user',array('uid' => $uid));
	}
	
}
