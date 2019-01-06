<?php
$title = "loading";
include "init.php";
if(isset($_POST['mail']) && isset($_POST['password'])){
	$mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
	$pass = $_POST['password'];
	$sql = "SELECT `email`,`password` FROM `users` WHERE `email` = \"$mail\" AND `password` = \"$pass\"";
	$res = $db->query($sql);
	if($res->num_rows){
		$_SESSION['logged']= 1;
		header("location: /");
		exit();
	}else{
		$_SESSION['error'] = 1;
		header("location: /");
                exit();
	}
}else{
	header("location: /");
	exit();
}
