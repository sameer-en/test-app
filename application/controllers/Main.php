<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
                if(!is_logged_in('admin') && !is_logged_in('user'))
                {
                    redirect(site_url('login'));
                }
                $this->load->model('login_model');
                $this->load->model('notifications_model');
                
                $this->load->helper('form');
		$this->load->library('form_validation');
		$this->config->load('form_validation',true);
		$this->data['sess_user_id'] = $this->session->user_id;	
                
                
	}

	public function index()
	{
		$data = array();

		/*------------ include required data & load views --------------*/
		$data['CUSTOM_PATH'] = $this->config->item('CUSTOM_PATH');
		$data['page_title'] = 'Dashboard';
		$data['arr_css'] =  array();
		$data['arr_js'] = [
                                    (site_url($data['CUSTOM_PATH']['assets_scripts']) .'index.js'),
				 ];
		$data['sidebar_active'] =  array('parent' => '','active' => 'dashboard');
		$data['sidebar'] = $this->load->view('includes/sidebar', $data, TRUE);
		$this->load->view('includes/header',$data);
                
		$this->load->view('index',$data);
		$this->load->view('includes/footer',$data);
		/*------------ include required data & load views --------------*/
	}
        
        
        public function update_profile()
	{
		$query = $this->login_model->get_one('*',['user_id' => $this->data['sess_user_id']] );
		if($query == FALSE)
		{
                    
			redirect(site_url('error/404'));
		}
                $data = $query->row_array();
		if(!isset($data['profile_pic']))  $profile_pic  = '';else $profile_pic  = $data['profile_pic'];
		$data['error_message'] = '';
		$old_profile_pic = $profile_pic;

		if($this->input->post())
		{
				// form validations are added in config/form_validation.php at central location
				if($old_profile_pic == '')
				{
					//make profile pic mandatory
				}
  				if ($this->form_validation->run("admin_update_profile") !== FALSE)
  				{
  					 $profile_pic = '';
  					 if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['name'] !='')
  					 {
  					 	 $config['file_name']            = $this->data['sess_user_id'];
  					 	 $config['overwrite']         	 = true; 
  					 	 $config['upload_path']          = USER_PHOTOS_URL;
		                 $config['allowed_types']        = 'gif|jpg|png';
		                 $config['max_size']             = 1000*5;
		                 $config['max_width']            = 1024;
		                 $config['max_height']           = 768;
		                 $this->load->library('upload', $config);
		 				if ( ! $this->upload->do_upload('profile_pic'))
		                {
		                        $data['error_message'] = print_r($this->upload->display_errors(),true);
		                }
		                else
		                {
		                	 $uploaded = array('upload_data' => $this->upload->data());
		                	 $profile_pic =  $uploaded['upload_data']['file_name'];
		                }

  					 }
                	 if($profile_pic == '' &&  $old_profile_pic !='') $profile_pic = $old_profile_pic;
                	 $data_update = [
									'firstname' => $this->input->post('firstname'),
									'lastname' => $this->input->post('lastname'),
									'designation' => $this->input->post('designation'),
									'phone_no' => $this->input->post('phone_no'),
									'skype_id' => $this->input->post('skype_id'),
									'updated_date' => date('Y-m-d H:i:s'),
									'profile_pic' => $profile_pic,
									];
					if($this->login_model->update(['user_id'=>$this->data['sess_user_id']],$data_update ) )
					{
						push_notification($this->data['sess_user_id'] ,0,date("Y-m-d H:i:s"),'update','log','User Profile Updated');

						$this->session->set_flashdata('fl_type','success');
                                                $this->session->set_flashdata('fl_heading','Profile Updated!!!');
                                                $this->session->set_flashdata('fl_message','Profile information successfully updated.');
					}
  				}
		}
                
                /*------------ include required data & load views --------------*/
		$data['CUSTOM_PATH'] = $this->config->item('CUSTOM_PATH');
		$data['page_title'] = 'Update Profile';
		$data['arr_css'] =  array();
		$data['arr_js'] = [
                                    site_url($data['CUSTOM_PATH']['assets_vendor']) .'jquery/dist/jquery.validate.min.js',
                                    site_url($data['CUSTOM_PATH']['assets_scripts']) .'admin_common.js',
				 ];
		$data['sidebar_active'] =  array('parent' => '','active' => 'dashboard');
		$data['sidebar'] = $this->load->view('includes/sidebar', $data, TRUE);
		$this->load->view('includes/header',$data);
                
		$this->load->view('update_profile',$data);
		$this->load->view('includes/footer',$data);
		/*------------ include required data & load views --------------*/
	}

	public function change_password()
	{
		$data['error_message'] = '';
		//$this->load->library('form_validation');
		if($this->input->post())
		{
			if ($this->form_validation->run('admin_update_password') !== FALSE)
			{
                            $data_update = [
                                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                                            'updated_date' => date('Y-m-d H:i:s'),
                                            ];

                                if($this->login_model->update_user($data_update, $this->data['sess_user_id'] ))
                                {
                                    push_notification($this->data['sess_user_id'] ,0,date("Y-m-d H:i:s"),'update','log','User Password Updated');

                                    $this->session->set_flashdata('fl_type','success');
                                    $this->session->set_flashdata('fl_heading','Password Updated!!!');
                                    $this->session->set_flashdata('fl_message','Password successfully updated.');
                                }
			}
		}

                /*------------ include required data & load views --------------*/
		$data['CUSTOM_PATH'] = $this->config->item('CUSTOM_PATH');
		$data['page_title'] = 'Update Profile';
		$data['arr_css'] =  array();
		$data['arr_js'] = [
                                    site_url($data['CUSTOM_PATH']['assets_vendor']) .'jquery/dist/jquery.validate.min.js',
                                    site_url($data['CUSTOM_PATH']['assets_scripts']) .'admin_common.js',
				 ];
		$data['sidebar_active'] =  array('parent' => '','active' => 'dashboard');
		$data['sidebar'] = $this->load->view('includes/sidebar', $data, TRUE);
		$this->load->view('includes/header',$data);
		$this->load->view('change_password',$data);
		$this->load->view('includes/footer',$data);
		/*------------ include required data & load views --------------*/
	}
        
        
        /*
         * This function is used to show all notifications
         */
        public function notifications()
        {
            $arrUsers = array(''=>'- All -');
            $arrData = $this->login_model->get_all('','user_status!="2"');
            foreach($arrData as $user)
            {
                $user = (array)$user;
                $arrUsers[$user['user_id']] = ucwords($user['firstname']." ".$user['lastname']);
            }
            $arrCats = [''=>'- All -','add'=>'add', 'update'=>'update', 'delete'=> 'delete', 'login'=>'login'];
            $arrTypes = [''=>'- All -','log'=>'log','message'=>'message', 'info'=> 'info'];
            
             $data['dropdownToUsers'] = form_dropdown('to_user_id',$arrUsers,'','id="to_user_id" class="form-control"');
             $data['dropdownFromUsers'] = form_dropdown('from_user_id',$arrUsers,'','id="from_user_id" class="form-control"');
             $data['dropdownNotificationCategory'] = form_dropdown('category',$arrCats,'','id="category" class="form-control"');
             $data['dropdownNotificationType'] = form_dropdown('noti_type',$arrTypes,'','id="noti_type" class="form-control"');
             
             /*------------ include required data & load views --------------*/
                    $data['CUSTOM_PATH'] = $this->config->item('CUSTOM_PATH');
                    $data['page_title'] = 'Notifications';
                    $data['arr_css'] =  array(
                                         site_url($data['CUSTOM_PATH']['assets_vendor']) .'datatables/datatables.min.css',
                                         site_url($data['CUSTOM_PATH']['assets_vendor']) .'datatables/dataTables.bootstrap.min.css',
                                     );
                    $data['arr_js'] = [
                                        site_url($data['CUSTOM_PATH']['assets_vendor']) .'datatables/datatables.min.js',
                                        site_url($data['CUSTOM_PATH']['assets_vendor']) .'datatables/dataTables.bootstrap.min.js',
                                        site_url($data['CUSTOM_PATH']['assets_scripts']) .'notifications_list.js',
                                      ];
                    $data['sidebar_active'] =  array('parent' => '','active' => 'dashboard');
                    $data['sidebar'] = $this->load->view('includes/sidebar', $data, TRUE);
                    $this->load->view('includes/header',$data);
                    $this->load->view('notifications/notification_list',$data);
                    $this->load->view('includes/footer',$data);
             /*------------ include required data & load views --------------*/
        }
        
        /*
         * This function is used to query all notifications ajax function
         */
        public function ajax_notifications()
        {
            $no = $this->input->post('start');
            $POST  = $this->input->post();
            $list = $this->notifications_model->get_datatables($POST['length'],$no,$POST);
            $data = array();

            foreach ($list as $notification) {
                    $action = '<a href="' . site_url("exp/update/" . $notification->noti_id) . '" title="Update record"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="javascript:void(0)" onclick="confirm_delete('. $notification->noti_id.',\'exp/delete\')" title="Delete record"><i class="glyphicon glyphicon-trash"></i></a>  ';/*data-toggle="modal" data-target="#myModal"*/
                     //$action = '<a href="' . site_url("exp/update/" . $notification->expid) . '" title="Update record"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="javascript:void(0)" onclick="confirm_delete('. $notification->expid.',\'exp/delete\')" title="Delete record"><i class="glyphicon glyphicon-trash"></i></a>  ';/*data-toggle="modal" data-target="#myModal"*/
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = ucwords($notification->ToFname.' '. $notification->ToLname);
                    $row[] = ucwords($notification->FrFname.' '. $notification->FrLname);
                    $row[] = $notification->category;
                    $row[] = $notification->noti_type;
                    $row[] = date(GLOBAL_DATE_TIME_FORMAT,strtotime($notification->added_date));
                    $row[] = $notification->message;
                    $row[] = $action;

                    $data[] = $row;
            }
            $output = array(
                                "draw" => $_POST['draw'],
                                "recordsTotal" => $this->notifications_model->count_all(),
                                "recordsFiltered" => $this->notifications_model->count_filtered($POST),
                                "data" => $data,
//                                "currentstart" => $this->notifications_model->count_filtered($POST)
                            );
            //output to json format
            echo json_encode($output);
        }
        
}
