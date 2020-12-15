<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
	<header id = "image" class="header-css">
        <a href="<?php echo base_url() ?>">
            <img src="<?php echo base_url(); ?>public/header.jpg" alt="Home Page" style="width:1500px;height:400px;">
        </a>
    </header>
        
	<div class="topnav" id="top-nav">
        <div id="menu-bar">
            <a class="active" href="<?php echo base_url() ?>">Trang chủ</a>
            <a href="<?php echo base_url() ?>Login">Mượn sách</a>
            <a href="<?php echo base_url() ?>MyBooks">Sách của tôi</a>
            <a href="#contact">Liên hệ</a>
        </div>
        
        <div class="topnav-right">
        <a href="<?php echo base_url() ?>Login">Login</a>
        <a href="<?php echo base_url() ?>Signup">Sign up</a>
        </div>
    </div>
	
</body>
</html>