<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array('error' => $this->session->userdata('error'));
		$this->load->view('login_view');
	}

	public function checkLogin()
	{
		$user_name = addslashes($this->input->post('user_name'));
		$password = md5(addslashes($this->input->post('psw')));
		$this->load->model('userAccount_model');
		$result = $this->userAccount_model->checkLogin($user_name, $password);
		if($result){
			$this->session->set_userdata('user_id', $result[0]['user_id']);
			
			$this->session->set_userdata('permission', $result[0]['permission']);
			
			$this->session->set_userdata('books', array());
			redirect(base_url(),'refresh');
		} else {			
			$this->session->set_userdata('error', TRUE);
			redirect(base_url() . 'login','refresh');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */