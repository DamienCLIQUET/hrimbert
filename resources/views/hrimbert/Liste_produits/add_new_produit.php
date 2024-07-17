<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$niveau = $_POST['niveau'];
$unite = $_POST['unite'];
$designation = $_POST['designation'];
$tarif = floatval($_POST['tarif']);
$retournewdesignation = $base->query("SELECT MAX(IDProduit) As maxi
FROM produits");
while ($datanewdesignation = $retournewdesignation->fetch()){
    echo $IDProduit = $datanewdesignation['maxi'] + 1;
}
$requete = "INSERT INTO produits
(IDProduit, description, unite, tarif)
VALUES ('".$IDProduit."', '".htmlspecialchars($designation, ENT_QUOTES)."', '".$unite."', '".$tarif."')";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
$requete = "INSERT INTO arborescence
(dad, type, son)
VALUES ('".$niveau."', 'A', '".$IDProduit."')";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>