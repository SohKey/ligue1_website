<?php

include('./src/model/GestionClassement.php');
include('./src/model/Classement.php');

$bdd = new GestionBDD();
$cnx = $bdd->connect();

$classementController = new GestionClassement($cnx);
$userController = new GestionUser($cnx);
$saisons = $classementController->getClassement();

include('./src/views/classement/classement.php');