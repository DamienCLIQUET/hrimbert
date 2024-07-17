<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$IDChantier = $_POST['IDChantier'];
$IDTitre = $_POST['IDTitre'];
$IDProduit = $_POST['IDProduit'];
$quantite = $_POST['quantite'];
$tarif = $_POST['tarif'];
$IDPosition = '1';
$retournewdetails_chantier = $base->query("SELECT MAX(IDPosition) As maxi
FROM details_chantier
WHERE IDChantier = '".$IDChantier."' AND IDTitre = '".$IDTitre."'");
while ($datanewdetails_chantier = $retournewdetails_chantier->fetch()){
    $IDPosition = $datanewdetails_chantier['maxi'] + 1;
}
/*$retourtarif = $base->query("SELECT tarif
FROM produits
WHERE IDProduit = '".$IDProduit."'");
while ($datatarif = $retourtarif->fetch()){
    $tarif = $datatarif['tarif'];
}*/
$requete = "INSERT INTO details_chantier
(IDChantier, IDProduit, IDTitre, IDPosition, quantite, tarif, remise, avancement, commentaires, createur, creation)
VALUES ('".$IDChantier."', '".$IDProduit."', '".$IDTitre."', '".$IDPosition."', '".$quantite."', '".$tarif."'
, '0', '0', '', '".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."')";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
if ($_POST['maj'] == true){
    $requete_update = "UPDATE produits
    SET tarif = '".$tarif."'
    WHERE IDProduit = '".$IDProduit."'";
    $retour_update = $base->query($requete_update);
    $save = $base->query("INSERT INTO historique (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete_update)."')");
}
?>