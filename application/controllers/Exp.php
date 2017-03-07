<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('exp_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		
		$cats = $this->common_model->get_all_cats();

		$arrCats = array('' => 'All');
		foreach ($cats as $catid => $catname) {
			$arrCats[$catid] = $catname;
		}

		$users = $this->common_model->get_all_users();

		$arrUsers = array('' => 'All');
		foreach ($users as $uid => $username) {
			$arrUsers[$uid] = $username;
		}

		$data['active_menu'] = 'exp';
		$data['form_cats'] = form_dropdown('catid',$arrCats,'','id="catid" class="form-control"');
		$data['form_users'] = form_dropdown('userid',$arrUsers,'','id="userid" class="form-control"');
		$data['form_exptypes'] = form_dropdown('exptype',['' => 'All','paid'=>'Paid by You','unpaid'=>'Need to pay (on credit)','received'=>'Income',],'','id="exptype" class="form-control"');

		$data['arr_js'] = [
							base_url('assets/datatables/js/jquery.dataTables.min.js'),
							base_url('assets/datatables/js/dataTables.bootstrap.min.js'),
							base_url('assets/js/exp_list.js'),
						  ];

		$this->load->view('header', $data);
		$this->load->view('exp_list', $data);
		$this->load->view('footer', $data);
	}

	public function ajax_list()
	{
		$list = $this->exp_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$total = 0;
		// echo '<pre>';print_r($list);die;
		foreach ($list as $customers) {
			$action = '<a href="' . site_url("exp/update/" . $customers->expid) . '" title="Update record"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="javascript:void(0)" onclick="confirm_delete('. $customers->expid.',\'exp/delete\')" title="Delete record"><i class="glyphicon glyphicon-trash"></i></a>  ';/*data-toggle="modal" data-target="#myModal"*/
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucfirst($customers->username);
			$row[] = $customers->catname;;
			$row[] = $customers->amount;
			$row[] = date("d-M-Y",strtotime($customers->expdate));
			$row[] = $customers->description;
			$row[] = $customers->comment;
			$row[] = $action;

			$data[] = $row;

			$total += $customers->amount;
		}
	// echo '<pre>';print_r($data);die;
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->exp_model->count_all(),
						"recordsFiltered" => $this->exp_model->count_filtered(),
						"data" => $data,
						"totalamount" => number_format($total,2),
				);
		//output to json format
		echo json_encode($output);
	}


	public function create()
	{
		if($this->input->post())
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('userid', 'User account', 'required');
			$this->form_validation->set_rules('catid', 'Category', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('expdate', 'Expense Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			//process records
			if ($this->form_validation->run() !== FALSE)
            {
                   $insertData = array(
                   				'userid' => $this->input->post('userid'),	
                   				'catid' => $this->input->post('catid'),	
                   				'amount' => $this->input->post('amount'),	
                   				'expdate' => $this->input->post('expdate'),	
                   				'description' => $this->input->post('description'),	
                   				'comment' => $this->input->post('comment'),	
                   				'exptype' => $this->input->post('exptype'),	
                   				);
                   if($this->exp_model->add_exp($insertData) ) 
                   {
                   		//redirect 
                   		redirect(site_url('exp/index'));
                   } 
                   else {
                    	# code...
                    } 
            }
		}

		$cats = $this->common_model->get_all_cats();

		$arrCats = array('' => '- Select -');
		foreach ($cats as $catid => $catname) {
			$arrCats[$catid] = $catname;
		}

		$users = $this->common_model->get_all_users();

		$arrUsers = array('' => '- Select -');
		foreach ($users as $uid => $username) {
			$arrUsers[$uid] = $username;
		}

		$init_data['amount'] =  $init_data['description'] = $init_data['comment'] = '';
		$init_data['expdate'] = date('Y-m-d');

		$data['form_data'] = $init_data;
		$data['form_cats'] = form_dropdown('catid',$arrCats,'','id="catid" class="form-control"');
		$data['form_users'] = form_dropdown('userid',$arrUsers,'','id="userid" class="form-control"');
		$data['form_exptypes'] = form_dropdown('exptype',['paid'=>'Paid by You','unpaid'=>'Need to pay (on credit)','received'=>'Income',],'','id="exptype" class="form-control"');

		$data['arr_js'] = [
							base_url('assets/jquery/jquery.validate.min.js'),
							base_url('assets/js/exp_add.js'),
						  ];

		$data['active_menu'] = 'exp';
		$this->load->view('header', $data);
		$this->load->view('exp_form', $data);
		$this->load->view('footer', $data);
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		$data['form_data'] = $this->exp_model->get_exp_details($id);

		//echo '<pre>';print_r($data['form_data'] );die;
		if($id == 0 || $data['form_data'] == false) 
		{
			redirect(site_url('exp/index'));
		}

		if($this->input->post())
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('userid', 'User account', 'required');
			$this->form_validation->set_rules('catid', 'Category', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('expdate', 'Expense Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			//process records
			if ($this->form_validation->run() !== FALSE)
            {
                   $insertData = array(
                   				'userid' => $this->input->post('userid'),	
                   				'catid' => $this->input->post('catid'),	
                   				'amount' => $this->input->post('amount'),	
                   				'expdate' => $this->input->post('expdate'),	
                   				'description' => $this->input->post('description'),	
                   				'comment' => $this->input->post('comment'),	
                   				'exptype' => $this->input->post('exptype'),	
                   				);
                   if($this->exp_model->update_exp($insertData,$id) ) 
                   {
                   		//redirect 
                   		redirect(site_url('exp/index'));
                   } 
                   else {
                    	# code...
                    } 
            }
		}

		$cats = $this->common_model->get_all_cats();

		$arrCats = array('' => '- Select -');
		foreach ($cats as $catid => $catname) {
			$arrCats[$catid] = $catname;
		}

		$users = $this->common_model->get_all_users();

		$arrUsers = array('' => '- Select -');
		foreach ($users as $uid => $username) {
			$arrUsers[$uid] = $username;
		}

		$data['form_cats'] = form_dropdown('catid',$arrCats,$data['form_data']['catid'],'id="catid" class="form-control"');
		$data['form_users'] = form_dropdown('userid',$arrUsers,$data['form_data']['userid'],'id="userid" class="form-control"');
		$data['form_exptypes'] = form_dropdown('exptype',['paid'=>'Paid by You','unpaid'=>'Need to pay (on credit)','received'=>'Income',],$data['form_data']['exptype'],'id="exptype" class="form-control"');

		$data['arr_js'] = [
							base_url('assets/jquery/jquery.validate.min.js'),
							base_url('assets/js/exp_add.js'),
						  ];

		$data['active_menu'] = 'exp';
		$this->load->view('header', $data);
		$this->load->view('exp_form', $data);
		$this->load->view('footer', $data);
	}

	public function delete()
	{
		$ret = ['status' => 'error','message' => 'Error in deleting record!'];
		$id = $this->input->post('id');
		if($id > 0)
		{
			if($this->exp_model->delete_exp($id))
			{
				$ret = ['status' => 'ok','message' => 'Record deleted succesfully!'];
			}
		}

		echo json_encode($ret);
	}

}
