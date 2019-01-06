<?php
	// connect file for easy edite when a small change happen like change mysql password or database name;
	// connect information
	$host	= "127.0.0.1";
	$u		= "root";
	$p		= "KJyu35J95TM7SsVF6sYv7SGd";
	$db		= "rush";

	// create new connection to the database
    $db = new mysqli("$host","$u","$p","$db");

	// Kill the Script in case the connect failed
    if ($db->connect_errno) {
		//die('Connect Error: ' . $mysqli->connect_error);
		die("error xf002120");
    }
?>
