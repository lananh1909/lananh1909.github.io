<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BorrowManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index()
	{
		$data = $this->book_model->getAllBorrow(0);
		$count = count($data);
		$data = array(
			'all_borrow' => $data,
			'num_borrow' => $count
		);
		$this->load->view('borrowManager_view', $data, FALSE);
	}

	public function getUsers()
	{
		$this->load->model('userAccount_model');
		$users = $this->userAccount_model->getAllUser(0);
		$users = json_encode($users);
		echo $users;
	}

	public function getBooks()
	{
		$books = $this->book_model->getBooks();
		$books = json_encode($books);
		echo $books;
	}

	public function addBorrow()
	{
		$user_id = $this->input->post('user_id');
		$book_id = $this->input->post('book_id');
		if($this->book_model->checkBookAvailable($book_id)){
			$this->book_model->sendBorrow($user_id, $book_id);
			echo '<script>alert("Success!")</script>';
			redirect(base_url() . 'BorrowManager','refresh');
		} else{
			echo '<script>alert("This book is out of stock")</script>';
			redirect(base_url() . 'BorrowManager','refresh');
		}
		
	}

	public function returnBorrow()
	{
		$borrow_id = $this->input->post('borrow_id');
		$book_id = $this->input->post('book_id');
		$this->book_model->returnBorrow($borrow_id, $book_id);
	}

	public function deleteBorrow()
	{
		$borrow_id = $this->input->post('borrow_id');
		$book_id = $this->input->post('book_id');
		$this->book_model->deleteBorrow($borrow_id, $book_id);
	}

	public function findBorow()
	{
		$selection = $this->input->post('selection');
		$user_id = $this->input->post('user_id');
		$book_id = $this->input->post('book_id');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$data = array();
		if($selection == '2'){
			$data = $this->book_model->getOutDateBorrow($user_id, $book_id, $from_date, $to_date);
		}else if($selection == '3'){
			$data = $this->book_model->findAllBorrow($user_id, $book_id, $from_date, $to_date);
		}else{
			$data = $this->book_model->findBorrows($selection, $user_id, $book_id, $from_date, $to_date);
		}
		$data = json_encode($data);
		echo $data;
	}

}

/* End of file BorrowManager.php */
/* Location: ./application/controllers/BorrowManager.php */