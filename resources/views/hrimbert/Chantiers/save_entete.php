<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$requete = "UPDATE chantier
SET client = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['client']), ENT_QUOTES)."'
, chantier = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['chantier']), ENT_QUOTES)."'
WHERE IDChantier = '".$_POST['IDChantier']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>