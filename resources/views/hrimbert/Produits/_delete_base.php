<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$requete = "DELETE FROM arborescence
WHERE son = '".$_POST['IDDetails']."'";
$retourdelete = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
$requete = "DELETE FROM produits
WHERE IDProduit = '".$_POST['IDDetails']."'";
$retourdelete = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>