<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('config.php');

$table = $_POST['table'];
$nom = $_POST['nom'];
$typeid = $_POST['typeid'];
$id = $_POST['id'];
$value = $_POST['value'];
$requete = "UPDATE ".$table."
SET ".$nom." = ".$value."
WHERE ".$typeid." = ".$id."";
$save_profil = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");