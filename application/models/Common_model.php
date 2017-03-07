<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_all_cats()
	{
		$this->db->select('*');
		$this->db->from('cateogry');
		$this->db->order_by('catid','asc');
		$query = $this->db->get();
		$result = $query->result();

		$cats = array();
		foreach ($result as $row) 
		{
			$cats[$row->catid] = $row->catname;
		}
		return $cats;
	}

	public function get_all_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('uid','asc');
		$query = $this->db->get();
		$result = $query->result();

		$usrs = array();
		foreach ($result as $row) 
		{
			$usrs[$row->uid] = $row->username;
		}
		return $usrs;
	}

}//end class
