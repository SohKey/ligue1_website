<?php

function password_pattern($mdp) {
	$majuscule = preg_match('@[A-Z]@', $mdp);
	$minuscule = preg_match('@[a-z]@', $mdp);
	$chiffre = preg_match('@[0-9]@', $mdp);
	if($majuscule && $minuscule && $chiffre && strlen($mdp) >= 8) echo 'ok';
	else {
		switch($mdp) {
			case strlen($mdp) < 8:
				$message = "8 caractères minimum";
				echo $message;
				break;
			case !$majuscule:
				$message = "majuscule";
				echo $message;
				break;
			case !$minuscule:
				$message = "minuscule";
				echo $message;
				break;
			case !$chiffre:
				$message = "chiffre";
				echo $message;
				break;
		}
	}
}

if(isset($_GET['password'])) {
	$password = $_GET['password'];
	password_pattern($password);
}