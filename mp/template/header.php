<!DOCTYPE html>
<html class="cufon-active cufon-ready" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Movie Props</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/nivo-slider.css" type="text/css" media="screen">
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../js/superfish.js" type="text/javascript"></script> 
    <script src="../js/jquery.nivo.slider.pack.js" type="text/javascript"></script>   
    <script src="../js/main.js" type="text/javascript"></script>   
</head>
<body id="main_page">
    <div class="main">
        <header>
            <div class="container">
                <h1>
                    <canvas id='logo'>
                        <b>This browser does not support HTML5 Canvas!</b>
                    </canvas>
                </h1>
                <h2><strong><strong>Movie Props</strong>We Believe in Fantasy, Originality<br>&amp; Customer Satisfaction</strong></h2>
                <nav>
                    <ul class="sf-menu sf-js-enabled">
                        <li class="first-item<?php if ($page == 'home') echo ' active'; ?>"><a class="item" href="controller.php?page=home">Home</a></li>
                        <li <?php if ($page == 'login' || $page == 'register' || $page == 'myinfo' || $page == 'myinterests' || $page == 'logout') echo 'class="active"'; ?>><a class="item" href="#">Account</a>
                            <ul style="display: none; visibility: hidden;">
                                <li <?php if ($page == 'login' || $page == 'processloggingin') echo 'class="active"'; ?>><a href="controller.php?page=login">Login</a></li>
                                <li <?php if ($page == 'register' || $page == 'processregistration') echo 'class="active"'; ?>><a href="controller.php?page=register">Register</a></li>
                                <li <?php if ($page == 'myinfo') echo 'class="active"'; ?>><a href="controller.php?page=myinfo">My Info</a></li>
                                <li <?php if ($page == 'myinterests') echo 'class="active"'; ?>><a href="controller.php?page=myinterests">My Interests</a></li>
                                <li class="last<?php if ($page == 'logout') echo ' active'; ?>"><a href="controller.php?page=logout">Logout</a></li>
                            </ul>
                        </li>
                        <li <?php if ($page == 'products') echo 'class="active"'; ?>><a class="item" href="controller.php?page=products">Products</a></li>
                        <li class="last-item<?php if ($page == 'aboutus') echo ' active'; ?>"><a class="item" href="controller.php?page=aboutus">About Us</a></li>
                        <li class="last-item<?php if ($page == 'admin' || $page == 'adminlogin' || $page == 'adminlogout') echo ' active'; ?>"><a class="item" href="controller.php?page=admin">Admin</a></li>
                    </ul>
                </nav>
                <?php include('../template/banner.php'); ?>
            </div>
        </header>