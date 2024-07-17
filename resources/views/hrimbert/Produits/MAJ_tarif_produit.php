<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$requete = "UPDATE produits
SET tarif = '".$_POST['tarif']."'
WHERE IDProduit = '".$_POST['IDProduit']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>