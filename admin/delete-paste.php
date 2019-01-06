<?php
	$title="Delete paste";
	include "init.php";
	if (isset($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$delete = "DELETE from pastes WHERE id=$id";
		if ($db->query($delete) == true)
			header("Location:http://10.11.100.228:81/");
		header("Location:http://10.11.100.228:81/");
	}
