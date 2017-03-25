<?php
class MY_Model extends CI_Model {

    /*
     * $tableName (string) :  Table name which is used in crud
     * $softDelete (int) : whether to hard delete from table or update status flag
     * $deleteStatus (string) : If softdelete then ENUM value of status 
     * $statusCol (string) : column name 
     * $column_order (array): set column field database for datatable orderable
     * $column_search (array) :set column field database for datatable searchable 
     * $order (array) : default order 
     * $dataTableWhere (array): where conditions array in query
     * $dataTableLike (array) : Like conditions array in query
     * $joinWith (array) : Join conditions array in query
     * 
     *     */
    
	protected $tableName = '';
	protected $softDelete = 0; // 0:no, 1: yes
	protected $deleteStatus = '2'; // enum value set for delete
	protected $statusCol = 'status'; // enum value set for delete
        protected $showSql = 0;
        
	var $column_order = array(); //set column field database for datatable orderable
	var $column_search = array(); //set column field database for datatable searchable 
	var $order = array(); // default order 
        var $dataTableSelect = array();
	var $dataTableWhere = array();
	var $dataTableLike = array();
	var $joinWith = array();
        var $otherConditions = array();

    function __construct($tableName ='',$softDelete = 1,$deleteStatus= '2' ,$statusCol='' )
    {
        parent::__construct();
        if($tableName !='')
        {
        	$this->tableName  = $tableName;
        }
        if($statusCol !='')
        {
        	$this->statusCol  = $statusCol;
        }
        $this->softDelete  = $softDelete;
        $this->deleteStatus  = $deleteStatus;
    }

    /*

     * add($data)
     * This method is used to add record to table defined. It accepts array having field=>value 
     * Returns last insert id on success or false on error. and error is shown
     *      */
    public function add($data)
    {
    	if($this->db->insert($this->tableName,$data))
			return $this->db->insert_id();
		else return false;
    }

    /* 
     * update($where,$data)
     * This method is used to update table values
     * $where : array where field=>value  or  plain where string condition.
     * $data : array of fields to be updated. field=>value pair
     * returns true on success or false on error.
     */
    public function update($where,$data)
    {
    	$this->db->set($data);
        if(is_array($where) && count($where)>0)
            $this->db->where($where);
       else if($where !='')
            $this->db->where($where);
       
       
        if($this->db->update($this->tableName))
                return true;
        else return false;
    }

    /*
     * delete($where)
     * This method is used to delete record from table. For soft delete we update status flag. and for hard delete we delete record
     * $where :  array where field=>value  or  plain where string condition.
     * returns true on success or false on error.
     */
    public function delete($where)
    {
    	if($this->softDelete == 1)
    	{
    		//update delete flag
    		return $this->update($where,[$this->statusCol=> $this->deleteStatus]);
    	}
    	else
    	{
    		//hard delete
    		$this->db->where($where);
		if($this->db->delete($this->tableName))
                    return true;
		else return false;
    	}
    }

     /*
     * joinWith($tableName,$on,$type)
     * This method is used to add join condition in sql. It requires all parameters
     * $tableName :  string table name onwhich join takes place.
     * $on : string. On condition. example: u.user_id= l.fk_user_id
     * $type : string . inner,left As specified by CI user guide
     * returns whole object
     */
    public function joinWith($arrData)
    { 
        foreach ($arrData as $key => $value) {
            $this->joinWith[] = [
                                'tableName' => $value[0],
                                'on' => $value[1],
                                'type' => $value[2],
                            ];
        } 
    	return $this;
    }

    /*
     * set_datatable_where($arrWhere)
     * This method is used to add where condition in sql. 
     * $data : array of where conditions.
     * returns whole object
     */
    public function set_datatable_where($arrWhere = array())
    {
//         echo '<pre>';print_r($arrWhere);die;
          foreach ($arrWhere as $where ) {
              if(count($where) == 2)
                $this->dataTableWhere[] = array($where[0],$where[1]);
               else 
                 $this->dataTableWhere[] = $where[0];
        } 
        return $this;
    }

     /*
     * set_datatable_like($arrLike)
     * This method is used to add like condition in sql. 
     * $data : array of like conditions.
     * returns whole object
     */
    
    public function set_datatable_like($arrLike = array())
    {
         foreach ($arrLike as $where ) {
              if(count($where) == 2)
                $this->dataTableLike[] = array($where[0],$where[1]);
               else 
                 $this->dataTableLike[] = $where[0];
        } 
	return $this;
    }
    /*
     * set_other_options($arr)
     * This function is used to set other where/ extra conditions that can not be managed by where and like method
     * Accepts array of conditions
     * returns whole object
     */
    public function set_other_options($arr = array())
    {
         foreach ($arr as $where ) {
             //echo '<pre>';print_r($where);die;
                 $this->otherConditions[] = $where;
        } 
	return $this;
    }
    

      /*
     * _get_datatables_query($postData)
     * This method is internaly used to prepare data for datatable. Main logic goes here.
     * $postData : array of post which contains all $_POST having search,order columns information 
     * returns nothing. sets data and parameters only.
     */
    
    protected function _get_datatables_query($postData = array())
	{
        
		if(!empty($this->dataTableWhere))
		{
                     foreach ($this->dataTableWhere as $where ) {
                            if(count($where) == 2)
                                 $this->db->where($where[0],$where[1]);
                             else 
                                 $this->db->where($where);
                      } 
		}

		if(!empty($this->dataTableLike))
		{
                    foreach ($this->dataTableLike as $where ) {
                            if(count($where) == 2)
                                 $this->db->like($where[0],$where[1]);
                             else 
                                 $this->db->like($where);
                      } 
		}

		$this->db->from($this->tableName);

		if(!empty($this->joinWith))
		{
			foreach($this->joinWith as $join)
			{
				$this->db->join($join['tableName'],$join['on'],$join['type']);
			}
		}
		
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if(isset($postData['search']['value']) && $postData['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $postData['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $postData['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($postData['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
                
                
                if(!empty($this->otherConditions))
                {
                    foreach($this->otherConditions as $conditions)
                    {
                        $functionName = $conditions[0];
                        if(isset($conditions[2]))
                        {
                            call_user_func_array (array($this->db,$functionName),[$conditions[1],$conditions[2]]); 
                        }
                        else
                        {
                            call_user_func_array (array($this->db,$functionName),[$conditions[1]]);
                        }
                    }
                }
	}

        /*
         * get_datatables($length = -1,$start = 0,$postData = array())
         * This function is called for listing of datatable from controllers
         * length : total no of records shown
         * start : page count
         * postData : array of post data used for searching sorting
         * returns array of records to show
         */
    public function get_datatables($length = -1,$start = 0,$postData = array())
	{
            $this->db->select($this->dataTableSelect,FALSE);
            $this->_get_datatables_query($postData);
            if($length != -1)
            $this->db->limit($length, $start);
            $query = $this->db->get();
            if($this->showSql==1) 
            {
                echo '<br/> get_datatables SQL:'.$this->db->last_query();die;
            }

            return $query->result();
	}

        /*
         * count_filtered
         * This function in used to count total no of records on searched criteria in table
         * returns total no of filtered records
         */
    public function count_filtered($postData)
    {
           $this->showSql = 0;
           $this->_get_datatables_query($postData);
           $query = $this->db->get();
           $this->db->flush_cache();
           if($this->showSql==1) 
            {
              echo '<br/> count_filtered SQL:'.$this->db->last_query();die;
            }
            return $query->num_rows();
    }

    /*
     * count_all
     * This function is used to count all records in table
     * retuns total no of records
     */
    public function count_all()
    {
            $this->db->from($this->tableName);
            return $this->db->count_all_results();
    }

    /*
     * get_all
     * This function is used to get all records from table
     * order by : order by condition string
     * returns array of result
     */
    public function get_all($orderBy='',$where = array())
    {
    	$this->db->select('*');
        $this->db->from($this->tableName);
        if(isset($orderBy))
                $this->db->order_by($orderBy);
        if(!empty($where))
                $this->db->where($where);
       
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * get_one($select='*',$where)
     * This function is used to select single record
     * select: string names of selected columns
     * where : array /string : where condition
     */
    public function get_one($select='*',$where)
    {
    	$this->db->select($select);
        $this->db->from($this->tableName);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
             return $query;
        }
        else return false;
    }
}

?>