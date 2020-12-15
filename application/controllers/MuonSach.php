<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MuonSach extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!isset($_SESSION['user_id'])){
			redirect(base_url() . 'Login','refresh');
		} else {
			if(isset($_SESSION['book'])){
				array_push($_SESSION['books'], $_SESSION['book']);
				$this->session->unset_userdata('book');
			}	
			$books = $this->session->userdata('books');
			$books = array('danhsachsachmuon' => $books);
			$this->load->view('muonSach_view', $books, FALSE);
		}				
	}

	public function deleteRow()
	{
		$row_id = $this->input->post('row_id');
		$books = $this->session->userdata('books');
		$len = count($books);
		$i = 0;
		foreach ($books as $key => $value) {
			if($key == $row_id){
				unset($books[$key]);
				echo "da xoa";
			}
		}
		
		$this->session->set_userdata('books', $books);
	}

	public function actionControl()
	{
		$check = $this->input->post();
		if(isset($check['sent'])){
			$books = $this->session->userdata('books');
			$user_id = $this->session->userdata('user_id');
			$len = count($books);
			if($len == 0){
				echo '<script>alert("Nothing to send!")</script>';
			} else {
				$this->load->model('book_model');
				foreach ($books as $key => $value) {
					$this->book_model->sendBorrow($user_id, $value[0]['book_id']);
				}
				$this->session->set_userdata('books', array());
				echo '<script>alert("Sent successfully!")</script>';
			}
			redirect(base_url() .'MyBooks','refresh');
		}

		if(isset($check['back']))
			redirect(base_url(),'refresh');
	}

}

/* End of file MuonSach.php */
/* Location: ./application/controllers/MuonSach.php */