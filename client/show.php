<?php
	error_reporting(E_ALL);
        ini_set('display_errors', 1);
        session_start();
        include "connect.php";
	if(isset($_GET['id']))
	{
		$code = $_GET['id'];
		$query = "SELECT * FROM pastes WHERE code = '$code'";
               	$results = $db->query($query);
		$results = $results->fetch_assoc();
		echo $results['title'] . "\n";
		echo $results['content'];
	}
	exit();
