<?php
	include "init.php";

	if(isset($_POST['paste'])){
		
		$my_file = "pastes/" . $_POST['name'];
		$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
		fwrite($handle, $_POST['paste'] . "\n");
		$_SESSION['download'] = 1;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$_POST['name'].'.txt"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($my_file)); //Absolute URL
		ob_clean();
		flush();
		readfile($my_file);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
