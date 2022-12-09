<?php
//session_save_path("../temp");
	session_start();	
	unset($_SESSION['store_name']);
	unset($_SESSION['id']);
	unset($_SESSION['timeout']);
	header("location:index.php");
