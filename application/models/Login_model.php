<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model {

	var $column_order = array(null, 'user_id','firstname','lastname','email','designation','comment','exptype'); //set column field database for datatable orderable
	var $column_search = array('user_id','firstname','lastname','email','designation','description','comment'); //set column field database for datatable searchable 
	var $order = array('user_id' => 'asc'); // default order

	public function __construct()
	{
            parent::__construct(TABLE_USER,1,'2','user_status');
	}

	public function check_login($email, $password)
	{
            $ret = array();
            $ret['status'] = false;
            $ret['msg'] = 'Enter valid email and password.';

            $where = ['email' => $email,'user_status' =>'1'];

            $query = $this->get_one('firstname,lastname,designation,profile_pic,user_role,user_id,password',$where);
            $result = $query->row_array();
            if($query->num_rows() > 0)
            {
                if(password_verify($password, $result['password']))
                {
                    $ret['status'] = true;
                    $ret['user_details'] = $result;
                }
            }
            return $ret;
	}

	public function update_user($data = array(), $user_id =0)
	{
            if(sizeOf($data) > 0 && $user_id > 0)
            {
                $this->update(['user_id'=> $user_id],$data);
                return $this->db->affected_rows();
            }
            else return false;
	}

	public function is_email_exists($email)
	{
            $ret = array();
            $ret['status'] = false;
            $ret['msg'] = 'Enter valid email';

            $where = ['email' => $email,'user_status' =>'1'];
            $query = $this->get_one('firstname,lastname,designation,profile_pic,user_role,user_id',$where);
            $result = $query->row_array();
          
            if($query->num_rows() > 0)
            {
                    $ret['status'] = true;
                    $ret['user_details'] = $result;
            }
            return $ret;
	}

}//end class
