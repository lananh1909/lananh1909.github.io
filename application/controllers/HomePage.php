<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomePage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
		$this->load->model('userAccount_model');
	}

	public function index()
	{	
		if(isset($_SESSION['permission']) && $this->session->userdata('permission')==1){
			$countBook = $this->book_model->countBook();
			$countBook = $countBook[0]["count(book_id)"];
			$countUser = $this->userAccount_model->countUser();
			$countUser = $countUser[0]['count(user_id)'];
			$countBorrow = $this->book_model->countBorrow();
			$countBorrow = $countBorrow[0]['count(borrow_id)'];
			$borrowing = $this->book_model->countBorrowing();
			$borrowing = $borrowing[0]['count(borrow_id)'];
			$lastUpdateBook = $this->book_model->getLastUpdateBook()[0]['max(last_update)'];
			$lastUpdateBorrow = $this->book_model->getLastUpdateBorrow()[0]['max(last_update)'];
			$lastUpdateUser = $this->userAccount_model->getLastUpdateUser()[0]['max(last_update)'];

			$data = array(
				'sumBooks' => $countBook,
				'sumUser' => $countUser,
				'sumBorrow' => $countBorrow,
				'sumBorrowing' => $borrowing,
				'lastUpdateUser' => $lastUpdateUser,
				'lastUpdateBook' => $lastUpdateBook,
				'lastUpdateBorrow' => $lastUpdateBorrow
			);
			$this->load->view('homePageAdmin_view', $data, FALSE);
		} else {
			$books = $this->book_model->getAllBook();
			$books = array('allbooks' => $books);
			$this->load->view('homePage_view', $books, FALSE);
		}		
	}

	public function getBookDetail($book_id)
	{
		$data = $this->book_model->getBookDetail($book_id);
		$this->load->view('book_detail_view', $data[0], FALSE);
	}

	public function addBorrow($book_id)
	{
		$data = $this->book_model->getBookDetail($book_id);
		if($data[0]['available'] > 0){
			$this->session->set_userdata('book', $data);
			redirect(base_url() .'/MuonSach','refresh');
		} else {
			echo '<script>alert("This book is out of stock")</script>';
			redirect(base_url() ,'refresh');
		}
		
	}

	public function findBook()
	{
		$result = array();
		$key = $this->input->post('keyword');
		if($key == ''){
			$result = $this->book_model->getAllBook();
		} else {
			$result = $this->book_model->findBookByKeyWord($key);
		}

		$result = json_encode($result);
		echo $result;
	}

	public function signOut()
	{
		if(isset($_SESSION['user_id'])){
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('permission');
			$this->session->unset_userdata('books');
			redirect(base_url(),'refresh');
		}
	}

}

/* End of file HomePage.php */
/* Location: ./application/controllers/HomePage.php */