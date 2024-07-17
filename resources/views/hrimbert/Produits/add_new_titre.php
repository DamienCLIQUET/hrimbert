<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$retournewtitre = $base->query("SELECT MAX(IDPosition) As maxi
FROM titres_chantier
WHERE IDChantier = '".$_POST['IDChantier']."'");
while ($datanewtitre = $retournewtitre->fetch()){
    $IDPosition = $datanewtitre['maxi'] + 1;
}
$requete = "INSERT INTO titres_chantier
(IDChantier, IDPosition, titre, createur, creation)
VALUES ('".$_POST['IDChantier']."', '".$IDPosition."', '".htmlspecialchars($_POST['titre'], ENT_QUOTES)."', '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_titre = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>