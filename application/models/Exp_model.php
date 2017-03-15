<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exp_model extends CI_Model {

	var $table = 'exp';
	var $column_order = array(null, 'userid','catid','amount','expdate','description','comment','exptype'); //set column field database for datatable orderable
	var $column_search = array('exp.userid','exp.catid','amount','expdate','exptype','description','comment'); //set column field database for datatable searchable 
	var $order = array('expid' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		// print_r($_POST);die;
		//add custom filter here
		if($this->input->post('catid'))
		{
			$this->db->where('exp.catid', $this->input->post('catid'));
		}
		if($this->input->post('userid'))
		{
			$this->db->where('exp.userid', $this->input->post('userid'));
		}
		if($this->input->post('amount'))
		{
			$this->db->like('amount', $this->input->post('amount'));
		}
		if($this->input->post('expdate_to') && $this->input->post('expdate'))
		{
			$this->db->where('expdate between "'.$this->input->post('expdate').'" AND "'.$this->input->post('expdate_to').'" ');
		}
		else if($this->input->post('expdate_to'))
		{
			$this->db->where('expdate <=', $this->input->post('expdate_to'));
		}
		else if($this->input->post('expdate'))
		{
			$this->db->like('expdate', $this->input->post('expdate'));
		}
		if($this->input->post('exptype'))
		{
			$this->db->where('exptype', $this->input->post('exptype'));
		}

		$this->db->from($this->table);
		$this->db->join('cateogry','exp.catid=cateogry.catid','inner');
		$this->db->join('users','exp.userid=users.uid','inner');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by("exp.".$this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by("exp.".key($order), $order[key($order)]);
		}
		
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		 // echo ">>>".$this->db->last_query();die;
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
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


	public function add_exp($data)
	{
		if($this->db->insert($this->table,$data))
			return $this->db->insert_id();
		else return false;
	}

	public function get_exp_details($id = 0)
	{
		if($id > 0)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('expid', $id );
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result_array()[0];
			}
			else return false;	
		}
		else return false;
	}

	public function update_exp($data,$id)
	{
		$this->db->set($data);
		$this->db->where('expid', $id);
		if($this->db->update($this->table))
			return true;
		else return false;
	}

	public function delete_exp($id)
	{
		if($id > 0)
		{
			$this->db->where('expid',$id);
		
			if($this->db->delete($this->table))
				return true;
			else return false;
		}
		else return false;
	}

}//end class
