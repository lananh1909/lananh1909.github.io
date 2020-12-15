<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class book_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAllBook()
	{
		$this->db->select('*');
		$this->db->from('book, language_table');
		$this->db->where('book.language_code = language_table.language_code');
		$this->db->order_by('last_update', 'desc');

		$this->db->limit(1000);

		$books = $this->db->get();
		$books = $books->result_array();
		return $books;
	}

	public function getBooks()
	{
		$this->db->select('*');
		$books = $this->db->get('book');
		$books = $books->result_array();
		return $books;
	}

	public function getBookDetail($id)
	{
		$this->db->select('*');
		$this->db->from('book, language_table');
		$this->db->where('book.language_code = language_table.language_code');
		$this->db->where('book_id', $id);
		$book = $this->db->get();
		$book = $book->result_array();
		return $book;
	}

	public function findBookByKeyWord($keyword)
	{
		$this->db->select('*');
		$this->db->from('book, language_table');
		$this->db->where("book.language_code = language_table.language_code && (title like '%" . $keyword . "%' or authors like '%" . $keyword . "%' or year(publication_date) like '%" . $keyword. "%' or language_name like '%" . $keyword. "%')");
		$this->db->order_by('last_update', 'desc');
		$book = $this->db->get();
		$book = $book->result_array();
		return $book;
	}

	public function sendBorrow($user_id, $book_id)
	{
		$this->db->set('available', 'available - 1', FALSE);
		$this->db->where('book_id', $book_id);
		$this->db->update('book');
		$data = array(
			'user_id' => $user_id,
			'book_id' => $book_id
		);
		$this->db->set('date_borrow', 'NOW()', FALSE);
		$this->db->insert('borrow', $data);
		return $this->db->insert_id();
	}

	public function getBookBorrowed()
	{
		$this->db->select('*');
		$this->db->from('borrow, book');
		$user_id = $this->session->userdata('user_id');
		$this->db->where('book.book_id = borrow.book_id');
		$this->db->where('user_id', $user_id);
		$this->db->where('state', 0);
		$result = $this->db->get();
		$result = $result->result_array();
		return $result;
	}

	public function checkBookAvailable($book_id)
	{
		$sql = 'select available > 0 from book where book_id = ' . $book_id;
		$result =  $this->db->query($sql);
		$result = $result->result_array();
		if($result[0]['available > 0'] == '0')
			return FALSE;
		else 
			return TRUE;
	}

	public function returnBook($borrow_id)
	{
		$this->db->set('state', '1', FALSE);
		$this->db->set('date_return', 'NOW()', FALSE);
		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->where('borrow_id', $borrow_id);
		$this->db->update('borrow');
	}

	public function countBook()
	{
		$this->db->select('count(book_id)');
		$result = $this->db->get('book');
		$result = $result->result_array();
		return $result;
	}

	public function countBorrow()
	{
		$this->db->select('count(borrow_id)');
		$result = $this->db->get('borrow');
		$result = $result->result_array();
		return $result;
	}

	public function countBorrowing()
	{
		$this->db->select('count(borrow_id)');
		$this->db->where('date_return is null');
		$result = $this->db->get('borrow');
		$result = $result->result_array();
		return $result;
	}

	public function getLastUpdateBook()
	{
		$this->db->select('max(last_update)');
		$result = $this->db->get('book');
		$result = $result->result_array();
		return $result;
	}

	public function getLastUpdateBorrow()
	{
		$this->db->select('max(last_update)');
		$result = $this->db->get('borrow');
		$result = $result->result_array();
		return $result;
	}

	public function deleteBook($book_id)
	{
		$this->db->where('book_id', $book_id);
		$this->db->delete('borrow');
		$this->db->where('book_id', $book_id);
		$this->db->delete('book');
	}

	public function getLanguage()
	{
		$this->db->select('*');
		$result = $this->db->get('language_table');
		$result = $result->result_array();
		return $result;
	}

	public function addBook($title, $authors, $language_code, $pages, $rating, $publication_date, $publisher, $book_image)
	{
		$data = array(
			'title' => $title, 
			'authors' => $authors,
			'language_code' => $language_code, 
			'num_page' => $pages,
			'rating' => $rating,
			'publication_date' => $publication_date,
			'publisher' => $publisher,
			'book_image' => $book_image
		);

		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->insert('book', $data);
		return $this->db->insert_id();
	}

	public function saveBook($book_id, $title, $authors, $language_code, $pages, $rating, $publication_date, $publisher, $book_image, $quantity, $available)
	{
		$data = array(
			'title' => $title, 
			'authors' => $authors,
			'language_code' => $language_code, 
			'num_page' => $pages,
			'rating' => $rating,
			'publication_date' => $publication_date,
			'publisher' => $publisher,
			'book_image' => $book_image,
			'quantity' => $quantity,
			'available' => $available
		);

		$this->db->where('book_id', $book_id);
		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->update('book', $data);
	}

	public function getAllBorrow($state)
	{
		$sql = 'select * from borrow, book, user_account where borrow.book_id = book.book_id && borrow.user_id = user_account.user_id && state = ' . $state;
		$result = $this->db->query($sql);
		$result = $result->result_array();
		return $result;
	}

	public function returnBorrow($borrow_id, $book_id)
	{
		$this->db->where('borrow_id', $borrow_id);
		$data = array(
			'state' => 1
		);
		$this->db->set('date_return', 'NOW()', FALSE);
		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->update('borrow', $data);

		$sql = 'update book set available = available + 1 where book_id = ' . $book_id;
		$this->db->query($sql);

		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->update('book');
	}

	public function deleteBorrow($borrow_id, $book_id)
	{
		$sql = 'select state from borrow where borrow_id = ' . $borrow_id;
		$result = $this->db->query($sql);
		$result = $result->result_array();
		var_dump($result[0]['state'] == "0");
		if($result[0]['state'] == "0"){
			$sql = 'update book set available = available + 1 where book_id = ' . $book_id;
			$this->db->query($sql);
			$this->db->set('last_update', 'NOW()', FALSE);
			$this->db->update('book');
		}	
		$this->db->where('borrow_id', $borrow_id);
		$this->db->delete('borrow');
		
	}

	public function dateProcess($from_date, $to_date)
	{
		$sql = "";
		if($from_date == "" && $to_date == ""){
		} else if($from_date == ""){
			$sql = $sql . "date(date_borrow) <= date('" . $to_date . "')";
		} else if($to_date == ""){
			$sql = $sql . "date(date_borrow) >= date('" . $from_date . "')";
		} else{
			$sql = $sql . "date(date_borrow) between date('" .$from_date . "') and date('" . $to_date . "')";
		}
		return $sql;
	}

	public function getOutDateBorrow($user_id, $book_id, $from_date, $to_date)
	{
		$sql = 'select * from borrow, book, user_account where borrow.book_id = book.book_id && borrow.user_id = user_account.user_id';
		if($user_id != ""){
			$sql = $sql . " && borrow.user_id = " . $user_id;
		}
		if($book_id != ""){
			$sql = $sql . " && borrow.book_id = " . $book_id;
		} 
		$string = $this->dateProcess($from_date, $to_date);
		if($string != ""){
			$sql = $sql . " &&" . $string;
		}
		$sql = $sql . ' && due_date < NOW()';
		$sql = $sql . ' && state = 0';
		$result = $this->db->query($sql);	
		$result = $result->result_array();
		return $result;
	}

	public function findAllBorrow($user_id, $book_id, $from_date, $to_date)
	{
		$sql = 'select * from borrow, book, user_account where borrow.book_id = book.book_id && borrow.user_id = user_account.user_id';
		if($user_id != ""){
			$sql = $sql . " && borrow.user_id = " . $user_id;
		}
		if($book_id != ""){
			$sql = $sql . " && borrow.book_id = " . $book_id;
		} 
		$string = $this->dateProcess($from_date, $to_date);
		if($string != ""){
			$sql = $sql . " &&" . $string;
		}
		$result = $this->db->query($sql);	
		$result = $result->result_array();
		return $result;
	}

	public function findBorrows($selection, $user_id, $book_id, $from_date, $to_date)
	{
		$sql = 'select * from borrow, book, user_account where borrow.book_id = book.book_id && borrow.user_id = user_account.user_id';
		if($user_id != ""){
			$sql = $sql . " && borrow.user_id = " . $user_id;
		}
		if($book_id != ""){
			$sql = $sql . " && borrow.book_id = " . $book_id;
		} 
		$string = $this->dateProcess($from_date, $to_date);
		if($string != ""){
			$sql = $sql . " &&" . $string;
		}	
		$sql = $sql . ' && state = ' . $selection;
		$result = $this->db->query($sql);	
		$result = $result->result_array();
		return $result;
	}

}

/* End of file book_model.php */
/* Location: ./application/models/book_model.php */