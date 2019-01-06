<?php
	function generateRandomString($length = 8) {
        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$charactersLength = strlen($characters);
        	$randomString = '';
        	for ($i = 0; $i < $length; $i++) {
                	$randomString .= $characters[rand(0, $charactersLength - 1)];
        	}
        	return $randomString;
	}
	
	function checkData($select, $from, $value){

		global $db;

		$query = "SELECT $select FROM $from WHERE $select = '$value'";
		$results = $db->query($query);

		$count   = $results->num_rows;

		return $count;

	}
