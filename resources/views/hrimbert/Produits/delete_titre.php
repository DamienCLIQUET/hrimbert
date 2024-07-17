<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$requete = "DELETE FROM details_chantier
WHERE IDChantier = '".$_POST['IDChantier']."' AND IDTitre = '".$_POST['IDTitre']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");

$requete = "DELETE FROM titres_chantier
WHERE IDTitre = '".$_POST['IDTitre']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>