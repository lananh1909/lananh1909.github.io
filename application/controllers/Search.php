<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index()
	{
		$books = $this->book_model->getAllBook();

		$books = array('allbooks' => $books);

		$this->load->view('search_view', $books, FALSE);	
	}
}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */