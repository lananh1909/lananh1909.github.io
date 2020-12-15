<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/header.css?ver=<?php echo rand(111,999)?>">
	
</head>
<body>
	<header id = "image" class="header-css">
        <a href="<?php echo base_url() ?>HomePage">
            <img src="<?php echo base_url(); ?>public/header.jpg" alt="Home Page" style="width:100%;height:400px;">
        </a>
    </header>
        
	<div class="topnav" id="top-nav">
        <div id="menu-bar">
            <a class="active" href="<?php echo base_url() ?>">Trang chủ</a>
            <a href="<?php echo base_url() ?>MuonSach">Mượn sách</a>
            <a href="<?php echo base_url() ?>MyBooks">Sách của tôi</a>
            <a href="#contact">Liên hệ</a>
        </div>
        
        <div class="topnav-right">
            <a href="<?php echo base_url() ?>UserAccount">My account</a>
            <a href="<?php echo base_url() ?>HomePage/signOut">Signout</a>
        </div>
    </div>
	
</body>
</html>