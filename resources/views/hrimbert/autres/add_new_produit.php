<?php
session_start();
include('../config.php');

$requete = "INSERT INTO chantier
(client, chantier, statut, createur, creation)
VALUES ('".$_POST['client']."', '".$_POST['chantier']."', '".$_POST['statut']."', '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_chantier = $base->query($requete);
$save = $base->query("INSERT INTO historique
(user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
$retournewchantier = $base->query("SELECT MAX(IDChantier) As maxi
FROM chantier");
while ($datanewchantier = $retournewchantier->fetch()){
    echo $IDChantier = $datanewchantier['maxi'];
}
?>