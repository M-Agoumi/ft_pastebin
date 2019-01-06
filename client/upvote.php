<?php
$title = "loading";
include "init.php";
if(isset($_GET['id']) && !empty($_GET['id'])){
	$code = $_GET['id'];
	$sql = "UPDATE `pastes` SET `upvote` = upvote + 1 WHERE `pastes`.`code` = '$code';";
	if ($db->query($sql)){	
		header("location: /$code");
		exit();
	}
}

