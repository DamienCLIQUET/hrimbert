<?php
session_start();
include('../config.php');

$user = $_POST['user'];
$date = $_POST['date'];
$requete = "UPDATE heures
SET valide = '1'
WHERE user = '".$user."' AND  date = '".$date."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>