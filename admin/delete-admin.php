<?php
	$title="Delete paste";
	include "init.php";
	if (isset($_GET['uid']))
	{
		$id = htmlspecialchars($_GET['id']);
		$delete = "DELETE from users WHERE userId=$id";
		if ($db->query($delete) == true)
			header("Location:http://10.11.100.228:81/");
		header("Location:http://10.11.100.228:81/");
	}
