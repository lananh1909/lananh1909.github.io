<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userAccount_model');
	}

	public function index()
	{
		$this->load->view('signup_view');
	}

	public function checkSignup()		
	{
		$user_name = addslashes($this->input->post('username'));
		$fullname = addslashes($this->input->post('name'));
		$gender = addslashes($this->input->post('gender'));
		$email = addslashes($this->input->post('email'));
		$password = md5(addslashes($this->input->post('psw')));
		$rePassword = md5(addslashes($this->input->post('psw-repeat')));
		$check1 = $this->userAccount_model->checkEmailExists($email);
		$check2 = $this->userAccount_model->checkUserExists($user_name);
		if($password != $rePassword){			
			$this->session->set_userdata('error_repsw', TRUE);
			redirect(base_url(). 'signup','refresh');
		} else {
			if ($check1) {
                $this->session->set_userdata('error_email', TRUE);
                redirect(base_url(). 'signup','refresh');
            }
            if ($check2){
                $this->session->set_userdata('error_name', TRUE);
                redirect(base_url(). 'signup','refresh');
            }
            if (!$check1 && !$check2 ){
                $result = $this->userAccount_model->addAccountToDatabase($user_name, $gender, $email, $fullname, $password, 0);

                if($result){
                	echo '<script>alert("Sign up successfully!")</script>';
                	redirect(base_url(). 'login','refresh');
                }
            } 
		}
	}

}

/* End of file Signup.php */
/* Location: ./application/controllers/Signup.php */