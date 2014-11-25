<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/11/10 09:05:00 
 * liuguangpingAuthor: 刘广平
 * Email: liuguangpingtest@163.com
 */
class T_user_model extends MY_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			auto_increment
	 * @COLUMN_COMMENT	??id
	 */
	public $uid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??
	 */
	public $email;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(36)
	 * @EXTRA			
	 * @COLUMN_COMMENT	???
	 */
	public $uname;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(36)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??
	 */
	public $nickname;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(32)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??
	 */
	public $pwd;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $phone;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(15)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $qq;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??1?2?0??
	 */
	public $sex;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $jointime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??ip
	 */
	public $joinip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		datetime
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		datetime
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $logintime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	??ip
	 */
	public $loginip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	-1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	-1???1????0???
	 */
	public $checkmail;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	0??1??2????
	 */
	public $type;

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

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(150)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????
	 */
	public $note;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	????ip
	 */
	public $onceip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0000-00-00 00:00:00
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $oncetime;

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
		return $this->db->get_where('t_user',array('uid' => $uid))->row();
	}
	

	

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_user');
	}

	

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($_POST)
	{
		if(!isset($post['sex']) || empty($post['sex'])) return false;
		if(!isset($post['jointime']) || empty($post['jointime'])) return false;
		if(!isset($post['checkmail']) || empty($post['checkmail'])) return false;
		if(!isset($post['type']) || empty($post['type'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;
		if(!isset($post['oncetime']) || empty($post['oncetime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($_POST)
	{
		if(!isset($post['uid']) || empty($post['uid'])) return false;
		if(!isset($post['sex']) || empty($post['sex'])) return false;
		if(!isset($post['jointime']) || empty($post['jointime'])) return false;
		if(!isset($post['checkmail']) || empty($post['checkmail'])) return false;
		if(!isset($post['type']) || empty($post['type'])) return false;
		if(!isset($post['state']) || empty($post['state'])) return false;
		if(!isset($post['oncetime']) || empty($post['oncetime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY uid
	*/
	public function delete($uid)
	{
		return $this->db->delete('t_user',array('uid' => $uid));
	}
	
}
