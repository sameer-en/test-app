<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		/*$this->load->library('zip');
		$name = 'mydata1.txt';
		$data = 'A Data String!';

		$this->zip->add_data($name, $data);

		// Write the zip file to a folder on your server. Name it "my_backup.zip"
		$this->zip->archive('my_backup.zip');

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip');*/

/*		$this->load->library('user_agent');
		echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
		echo '>>>>>'.$this->agent->referrer();*/
	
/*$this->load->database();
$this->db->cache_on();
$query = $this->db->query('select * from lang_vars where lang_id=1');
if($query->num_rows() > 0)
{
	foreach($query->result() as $data)
	{
		$lang[$data->lbl] = $data->msg;
		//echo '<pre>';print_r($data);die;
	}
}
$this->db->cache_off();
*/


		$this->lang->load('lang1');
		$this->load->view('welcome_message');
	}
}
