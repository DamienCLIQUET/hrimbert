<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$niveau = $_POST['niveau'];
$arborescence = $_POST['arborescence'];
$retournewarborescence = $base->query("SELECT MAX(IDProduit) As maxi
FROM produits");
while ($datanewarborescence = $retournewarborescence->fetch()){
    $IDProduit = $datanewarborescence['maxi'] + 1;
}
$requete = "INSERT INTO produits
(IDProduit, description, tarif)
VALUES ('".$IDProduit."', '".$arborescence."', '0')";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
$requete = "INSERT INTO arborescence
(dad, type, son)
VALUES ('".$niveau."', 'N', '".$IDProduit."')";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>