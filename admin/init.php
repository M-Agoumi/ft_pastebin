<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	include "connect.php";
	include "includes/header.php";
	include "includes/function.php";
	if(!isset($skip)){
		if(!isset($_SESSION['logged'])){
			header("location: /");
		}	
	}
