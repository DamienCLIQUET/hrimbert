<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$requete = "UPDATE arborescence
SET dad = '".$_POST['dad']."'
WHERE son = '".$_POST['son']."'";
$retour_description_produit = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>