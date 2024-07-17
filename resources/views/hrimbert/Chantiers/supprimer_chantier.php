<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

echo $IDChantier = $_POST['IDChantier'];

$requetechantier = "UPDATE chantier
SET statut = '0'
WHERE IDChantier = '".$IDChantier."'";
$deletechantier = $base->query($requetechantier);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetechantier)."')");

/*$requetechantier = "DELETE FROM chantier
WHERE IDChantier = '".$IDChantier."'";
$deletechantier = $base->query($requetechantier);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetechantier)."')");

$requeteactions = "DELETE FROM actions
WHERE IDChantier = '".$IDChantier."'";
$deleteactions = $base->query($requeteactions);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requeteactions)."')");

$requetedetails_chantier = "DELETE FROM details_chantier
WHERE IDChantier = '".$IDChantier."'";
$deletedetails_chantier = $base->query($requetedetails_chantier);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetedetails_chantier)."')");

$requetepoints = "DELETE FROM points
WHERE IDChantier = '".$IDChantier."'";
$deletepoints = $base->query($requetepoints);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetepoints)."')");

$requetetitres_chantier = "DELETE FROM titres_chantier
WHERE IDChantier = '".$IDChantier."'";
$deletetitres_chantier = $base->query($requetetitres_chantier);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetetitres_chantier)."')");
?>*/