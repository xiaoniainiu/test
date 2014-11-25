<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At {_datetime_} 
 * dinghaochenAuthor: 刘广平
 * Email: liuguangpingtest@163.com
 */
class {_classname_} extends CI_Model
{
	{_fields_}

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	{_m_get_by_primary_key_}

	/**
	 * 获取记录列表
	 * 
	 * 默认参数：获取按主键升序排列的前10条记录
	 *
	 * @param $limit		每页纪录数
	 * @param $offset		结果集的偏移
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 * get_list(10,0) =>	select * from {_tablename_} limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = '{_important_primary_key_name_}', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('{_tablename_}', $limit, $offset)->result();
	}

	/**
	 * 获取所有记录
	 *
	 * 默认参数：获取按主键升序排列的所有记录
	 *
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 */
	public function get_all($order_field = '{_important_primary_key_name_}', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('{_tablename_}')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('{_tablename_}');
	}

	/**
	 * 查询	
	 *
	 * 默认参数：根据查询字段和关键词，返回按主键升序排列的前10条记录
	 *
	 * @param $field_name	查询的字段
	 * @param $keywords		查询的关键字
	 * @param $limit		每页纪录数
	 * @param $offset		结果集的偏移
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 */
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = '{_important_primary_key_name_}', $order_type = 'ASC')
	{
		$this->db->from('{_tablename_}')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
		return $this->db->get()->result();
	}

	/**
	 * 获取满足查询条件的所有记录总数，用于查询结果的分页
	 *
	 * @param $field_name	查询的字段
	 * @param $keywords		查询的关键字
	 *
	 * @return				整形
	 */
	public function count_search($field_name, $keywords)
	{
		$this->db->from('{_tablename_}')->like($field_name, $keywords);
		return $this->db->count_all_results();
	}

	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->insert()
	 */
	public function insert()
	{
		$this->db->insert('{_tablename_}', $this);
		return $this->db->insert_id();
	}

	/**
	 * 更新一条记录
	 *
	 * @Exception			Exception
	 * 
	 * @return				return $this->db->update()
	 */
	public function update($data,$where)
	{
		
		$this->db->update('{_tablename_}', $data, $where);
		return $this->db->affected_rows()?true:false;
	}

	/**
	 * 根据条件得到单条数据
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->getOne()
	 */
	public function getOne($field='{_important_primary_key_name_}',$where)
	{
		return $this->db->select($field)->get_where('{_tablename_}', $where)->row();
	}


	/**
	 * 根据条件得到数据集合
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->getAll()
	 */
	public function getAll($field='*',$where)
	{
		return $this->db->select($field)->get_where('{_tablename_}', $where)->result();
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		{_validation_content_by_insert_}

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		{_validation_content_by_update_}

		return true;
	}

	{_m_delete_by_primary_key_}
}
