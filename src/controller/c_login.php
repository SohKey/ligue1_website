<?php

if (isset($_SESSION['UserInfo'])) {
    exit(header("Location: /profile"));
} 


$bdd = new GestionBDD();

$statusMessage = "";
$class = "";

if (isset($_POST['login'])) {
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];

    $cnx = $bdd->connect();
    $userController = new GestionUser($cnx);

    if ($userController->auth_user($email, $password)) {
        header("Location: /profile");
    } 
    $statusMessage = "Wrong username / password";
    $class = "text-red-500 font-bold";

}

include('./src/views/login.php');
