<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends MY_Model {

	var $column_order = array(null, 'to_user_id','from_user_id','category','noti_type','added_date'); //set column field database for datatable orderable
	var $column_search = array('to_user_id','from_user_id','added_date','category','noti_type','message','toU.firstname','toU.lastname'); //set column field database for datatable searchable 
        var $dataTableSelect = array('noti_id',  'to_user_id','from_user_id','added_date','category','noti_type','message','toU.firstname as ToFname','toU.lastname as ToLname','frU.firstname as FrFname','frU.lastname as FrLname');
	var $order = array('added_date' => 'desc'); // default order
        var $showSql = 0;
        var $otherConditions = array();
        
	public function __construct()
	{
            parent::__construct(TABLE_NOTIFICATIONS,0);
	}

	public function get_datatables($length = -1,$start = 0,$postData = array())
	{
           /* ------ join conditions if any ----------*/
                $this->joinWith(array([TABLE_USER.' as toU','toU.user_id='.TABLE_NOTIFICATIONS.'.to_user_id','inner'],[TABLE_USER.' as frU','frU.user_id='.TABLE_NOTIFICATIONS.'.from_user_id','inner'] ));
            /* ------ assign post conditions if any ----------*/   
                $arrWhere = $arrLike = array();
                
                if($postData['to_user_id'])
		{
                        $arrWhere[] = array('to_user_id', $postData['to_user_id']);
		}
                if($postData['from_user_id'])
		{
                         $arrWhere[] = array('from_user_id', $postData['from_user_id']);
		}
                if($postData['category'])
		{
                          $arrWhere[] = array('category', $postData['category']);
		}
                if($postData['noti_type'])
		{
                         $arrWhere[] = array('noti_type', $postData['noti_type']);
		}
                if($postData['added_date_to'] && $postData['added_date'])
		{
                         $arrWhere[] = array('DATE_FORMAT(added_date,"%Y-%m-%d") between "'.$postData['added_date'].'" AND "'.$postData['added_date_to'].'" ');
		}
		else if($postData['added_date_to'])
		{
                     $arrWhere[] = array('DATE_FORMAT(added_date,"%Y-%m-%d") <=', $postData['added_date_to']);
		}
		else if($postData['added_date'])
		{
                    $arrWhere[] = array('DATE_FORMAT(added_date,"%Y-%m-%d")', $postData['added_date']);
		}
                 if($postData['message'])
		{
                      $arrLike[] = array('message', $postData['message']);
		}
                
                /*---  experimental ( add methods other than where and like in sql for datatable) ---*/
                /*
                    $this->db->start_cache();
                    $names = array(1,2,3);
                    $this->db->where_not_in('to_user_id', $names);
                    $this->db->stop_cache();
                 */
                /*---  experimental ---*/        
                
                $this->set_datatable_where($arrWhere);
                $this->set_datatable_like($arrLike);
                $this->set_other_options(
                            array(
                                    // format : $this->db-> METHOD NAME , parameter1 (usually column name/plain condition), paramater 
                                    // related to column name
//                                ["where_in",'from_user_id',[2,3]],
//                                ["where",'to_user_id','2'],
//                                ["where",'to_user_id!=2'],
                                //["select_sum",'to_user_id']
                            )
                        );
                
                $this->showSql = 0;
            /* ------ call parent models datatable function to get records ----------*/    
		$result =  parent::get_datatables($length,$start,$postData);
		return $result;
	}
}//end class
