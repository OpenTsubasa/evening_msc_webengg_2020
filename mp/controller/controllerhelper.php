<?php
	
	include('../config/config.php');
	include('../model/model.php');

	$header = '../template/header.php';
	$footer = '../template/footer.php';
	$error = '../view/error.php';
	$incomplete = '../view/incomplete.php';

	function SanitizeString($str) {
	    $str = strip_tags($str);
	    $str = htmlentities($str);
	    return stripslashes($str);
	}

	function GetJSONData() {
		$url = "http://webdev.student.uws.ac.uk/movie-trivia.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return json_decode($output, true);
	}

?>