<?php

if (isset($_SESSION['UserInfo'])) {
    exit(header("Location: /profile"));
} 

include('./src/model/GestionClub.php');
include('./src/model/Club.php');

$bdd = new GestionBDD();
$cnx = $bdd->connect();

$gclubs = new GestionClub($cnx);
$clubs = $gclubs->getListClub();

$userController = new GestionUser($cnx);

function check_mdp_format($mdp) {
	$majuscule = preg_match('@[A-Z]@', $mdp);
	$minuscule = preg_match('@[a-z]@', $mdp);
	$chiffre = preg_match('@[0-9]@', $mdp);
	
	if(!$majuscule || !$minuscule || !$chiffre || strlen($mdp) < 8) return false;
	return true;
}

function register_checks($newUser, $userController) {
	$mail = $newUser->getMailUti();
	$password = $newUser->getPasswordUti();

	if ($userController->isAlreadyUsed($mail)) {
		return "Le mail ". $mail . " est déjà enregistré";
	}

	if (check_mdp_format($password)) {
		$newUser->setPasswordUti(password_hash($password, PASSWORD_DEFAULT)); // hash password & update user
		$userController->register($newUser);
		sleep(0.25);
		if($userController->auth_user($mail, $password)) exit(header("Location: /profile"));
		return "Une erreure est survenue";

	} return "Mauvais format de mot de passe !";
}

$message = "";

if (isset($_POST['register'])) {

	if($_REQUEST['verif'] != null) {
		$message = "bot detected";
		return;
	} 
               
	$club = $_REQUEST['club'];
	$nom = $_REQUEST['nom'];
	$prenom = $_REQUEST['prenom'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$sexe = $_REQUEST['sexe'];
	$image = $_FILES['photo']['name'];

	define('TARGET', '/assets/avatar/');    // Repertoire cible

	if(isset($image) and !empty($image)){
		$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
		$extension  = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

		if(in_array(strtolower($extension),$tabExt)){
			$nomImage = md5(uniqid()) .'.'. $extension;
			$photo = TARGET.$nomImage;
			move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
		} 
	} else {
		$photo = TARGET."defaultuser.png";
	}

	$newUser = new User('', (int)$club, $nom, $prenom, $sexe, $password, 'now', $photo, $email, false);
	$message = register_checks($newUser, $userController);
}

include('./src/views/register.php');


