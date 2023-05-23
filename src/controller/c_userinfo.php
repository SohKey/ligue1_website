<?php

if (!isset($_SESSION['UserInfo'])) {
    header("Location: /login");
} 

include('./src/model/GestionClub.php');
include('./src/model/Club.php');

$bdd = new GestionBDD();
$cnx = $bdd->connect();
$userController = new GestionUser($cnx);
$gclubs = new GestionClub($cnx);

$user = $userController->get_user_byid($_SESSION['UserInfo']->id);

$users = $userController->get_users_list();

include('./src/views/userinfo/userinfo.php');
