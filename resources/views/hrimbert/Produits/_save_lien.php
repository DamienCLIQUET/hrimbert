<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$refart = $_POST['refart'];
$lien = $_POST['lien'];
$IDProduit = $_POST['IDProduit'];
$requete = "UPDATE produits
SET ".$refart." = '".$lien."'
WHERE IDProduit = '".$IDProduit."'";
$retour_tarif_base_produit = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>