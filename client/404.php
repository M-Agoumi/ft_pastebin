<?php
	$title = "loading";
	include "init.php";
	$code = substr($_SERVER['REQUEST_URI'], 1);
	if(checkData("code", "pastes", $code)){
		// fetch data from the database and show them if nothing is wrong
		$query = "SELECT * FROM pastes WHERE code = '$code'";
		$results = $db->query($query);
		$results = $results->fetch_assoc();
		print_r($results);
	}else{
		//include the real 404 page
		echo "not found";
	}
?>
