<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Book</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/header.css?ver=<?php echo rand(111,999)?>">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>1.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>1.css">
</head>
<body>
  <?php
        if(isset($_SESSION['user_id'])){
            require('headerAfterLogin.php');
        } else {
          require('header.php');
        }
      ?>
  <div class="container">
    <div class="text-xs-center">
      <h4 class="display-3">Thông tin sách</h4>
      <hr>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="<?php echo base_url() ?>HomePage/addBorrow/<?php echo $book_id ?>">
      <div class="container text-xs-center" style="margin-bottom: 20px;">
          <img src="<?php 
          if($book_image == NULL)
            echo base_url().'public/download.png';
          else
            echo base_url() . $book_image; ?>" alt="Book image" style="width: 400px; height: 400px;">
      </div>
      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="title" class="col-sm-2 col-form-label text-xs-right">Title</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" value="<?php echo $title ?>" required readonly>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="authors" class="col-sm-2 col-form-label text-xs-right">Authors</label>
            <div class="col-sm-10">
              <input type="text" name="authors" class="form-control" id="authors" value="<?php echo $authors ?>" required readonly>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="language" class="col-sm-2 col-form-label text-xs-right">Language</label>
            <div class="col-sm-10">
              <input type="text" name="language" class="form-control" id="language" value="<?php echo $language_name ?>" readonly>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="num_page" class="col-sm-2 col-form-label text-xs-right">Pages</label>
            <div class="col-sm-10">
              <input type="number" name="num_page" class="form-control" id="num_page" value="<?php echo $num_page ?>" readonly>
            </div>
          </div>
        </div>
      </div> 

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="rating" class="col-sm-2 col-form-label text-xs-right">Rating</label>
            <div class="col-sm-10">
              <input type="text" name="rating" class="form-control" id="rating" value="<?php echo $rating ?>" readonly>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="publication_date" class="col-sm-2 col-form-label text-xs-right">Date</label>
            <div class="col-sm-10">
              <input type="text" name="publication_date" class="form-control" id="publication_date" value="<?php echo $publication_date ?>" readonly>
            </div>
          </div>
        </div>
      </div>  

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="publisher" class="col-sm-2 col-form-label text-xs-right">Publisher</label>
            <div class="col-sm-10">
              <input type="text" name="publisher" class="form-control" id="publisher" value="<?php echo $publisher ?>" readonly>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="row">
            <label for="available" class="col-sm-2 col-form-label text-xs-right">Available</label>
            <div class="col-sm-10">
              <input type="text" name="available" class="form-control" id="available" value="<?php echo $available ?>" readonly>
            </div>
          </div>
        </div>
      </div>    

      <div id="action-add" class="form-group row">
        <div class="col-sm-6 text-xs-left">
          <button type="button" onclick="back()" class="btn btn-outline-success">BACK</button>
        </div>
        <div class="col-sm-6 text-xs-right">
          <button type="submit" class="btn btn-outline-success">ADD</button>
        </div>
      </div>
    </form>
    <hr>
  </div>

  <script>

    function back() {
        window.location.href = '<?php echo base_url() ?>';
    }
    
  </script>

	
</body>
</html>