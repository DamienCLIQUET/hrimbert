<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$requete = "UPDATE titres_chantier
SET titre = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['titre']), ENT_QUOTES)."'
WHERE IDTitre = '".$_POST['IDTitre']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>