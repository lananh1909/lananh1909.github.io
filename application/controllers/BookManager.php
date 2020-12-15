<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BookManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index()
	{	
		$books = $this->book_model->getAllBook();
		$num_books = count($books);
		$books = array(
			'allbooks' => $books,
			'num_books' => $num_books
		);

		$this->load->view('bookManager_view', $books, FALSE);
	}

	public function getLanguage()
	{
		$language = $this->book_model->getLanguage();
		$language = json_encode($language);
		echo $language;
	}

	public function addBook()
	{	
		if(empty($_FILES["book_image"]["name"])){
			$avatarurl = NULL;
		} else {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["book_image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["book_image"]["tmp_name"]);
			  if($check !== false) {
			    //echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    echo '<script>alert("File is not an image.")</script>';
			    redirect(base_url(). 'BookManager','refresh');
			    $uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  $avatarurl = 'uploads/'. basename($_FILES["book_image"]["name"]);
			}

			// Check file size
			if ($_FILES["book_image"]["size"] > 500000) {
			  echo '<script>alert("Sorry, your file is too large.")</script>';
			  redirect(base_url(). 'BookManager','refresh');
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
			  redirect(base_url(). 'BookManager','refresh');
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo '<script>alert("Sorry, your file was not uploaded.")</script>';
			  redirect(base_url(). 'BookManager','refresh');
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
			    //echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
			  } else {
			    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
			   	$uploadOk = 0;
			  }
			}
			if($uploadOk == 1){
				$avatarurl = 'uploads/'. basename($_FILES["book_image"]["name"]);
			}
		}
		

		$title = $this->input->post('title');
		$authors = $this->input->post('authors');
		$language_code = $this->input->post('language');
		$pages = $this->input->post('num_page');
		$rating = $this->input->post('rating');
		$publication_date = $this->input->post('publication_date');
		$publisher = $this->input->post('publisher');
		if($this->book_model->addBook($title, $authors, $language_code, $pages, $rating, $publication_date, $publisher, $avatarurl)){
			echo '<script>alert("Insert book successfully!")</script>';
            redirect(base_url(). 'BookManager','refresh');
		}
	}

	public function editBook($book_id)
	{
		$data = $this->book_model->getBookDetail($book_id);
		$this->load->view('editBook_view', $data[0], FALSE);
	}

	public function saveChange($book_id)
	{
		if(empty($_FILES["book_image"]["name"])){
			$avatarurl = $this->input->post('old-image');
		} else {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["book_image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["book_image"]["tmp_name"]);
			  if($check !== false) {
			    //echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    echo '<script>alert("File is not an image.")</script>';
			    redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
			    $uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  $avatarurl = 'uploads/'. basename($_FILES["book_image"]["name"]);
			}

			// Check file size
			if ($_FILES["book_image"]["size"] > 500000) {
			  echo '<script>alert("Sorry, your file is too large.")</script>';
			  redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
			  redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo '<script>alert("Sorry, your file was not uploaded.")</script>';
			  redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
			    //echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
			  } else {
			    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
			    redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
			   	$uploadOk = 0;
			  }
			}
			if($uploadOk == 1){
				$avatarurl = 'uploads/'. basename($_FILES["book_image"]["name"]);
			}
		}

		$title = $this->input->post('title');
		$authors = $this->input->post('authors');
		$language_code = $this->input->post('language');
		$pages = $this->input->post('num_page');
		$rating = $this->input->post('rating');
		$publication_date = $this->input->post('publication_date');
		$publisher = $this->input->post('publisher');
		$quantity = $this->input->post('quantity');
		$old_quantity = $this->input->post('old-quantity');
		$available = $this->input->post('available');
		$borrowed = $old_quantity - $available;
		if($quantity < $borrowed){
			echo '<script>alert("Your input quantity is not valid!")</script>';
			redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
		} else {
			$available =$quantity - $borrowed;
			$this->book_model->saveBook($book_id, $title, $authors, $language_code, $pages, $rating, $publication_date, $publisher, $avatarurl, $quantity, $available);
			echo '<script>alert("Your changes are saved!")</script>';
			redirect(base_url() . 'BookManager/editBook/'. $book_id,'refresh');
		}
		
	}

	public function deleteBook()
	{	
		$book_id = $this->input->post('book_id');
		$this->book_model->deleteBook($book_id);
		echo "success";
	}

}

/* End of file BookManager.php */
/* Location: ./application/controllers/BookManager.php */