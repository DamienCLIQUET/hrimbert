<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$requete = "DELETE FROM details_chantier
WHERE IDDetails = '".$_POST['IDDetails']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>