<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyBooks extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index()
	{	
		$data = $this->book_model->getBookBorrowed();
		$data = array('danhsachsachmuon' => $data);
		$this->load->view('listBookBorrowed_view', $data, FALSE);
	}

	public function returnBook()
	{
		$borrow_id = $this->input->post('borrow_id');
		$this->book_model->returnBook($borrow_id);
		echo "success";
	}

	

}

/* End of file MyBooks.php */
/* Location: ./application/controllers/MyBooks.php */