<?php
session_start();
include('../config.php');

$requete = "INSERT INTO actions
(IDChantier, type, date, commentaire, createur, creation)
VALUES ('".$_POST['IDChantier']."', '".$_POST['type']."', '".date('Y-m-d H:i:s', strtotime($_POST['date']))."', '".htmlspecialchars($_POST['commentaire'], ENT_QUOTES)."', '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_titre = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>