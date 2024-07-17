<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('config.php');

$table = $_POST['table'];
$newuser = $_POST['newuser'];
$newpass = $_POST['newpass'];
$newprofil = $_POST['newprofil'];
$requete = "INSERT INTO ".$table."
(userhr, passhr, profil)
VALUES ('".$newuser."', '".$newpass."', '".$newprofil."')";
$save_profil = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
echo "Utilisateur créé";