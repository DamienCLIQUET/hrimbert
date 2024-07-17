<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$retourtarif = $base->query("SELECT produits.IDProduit, produits.tarif
FROM details_chantier
INNER JOIN produits
ON details_chantier.IDProduit = produits.IDProduit
WHERE IDDetails = '".$_POST['IDDetails']."'");
while ($datatarif = $retourtarif->fetch()){
    $tarif = $datatarif['tarif'];
    $IDProduit = $datatarif['IDProduit'];
}
$requete = "UPDATE details_chantier
SET quantite = '".$_POST['quantite']."'
, remise = '".$_POST['remise']."'
, tarif = '".$_POST['tarif']."'
, modifieur = '".$_SESSION['userhr']."'
, modification = '".date('Y-m-d H:i:s')."'
WHERE IDDetails = '".$_POST['IDDetails']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
if ($tarif != $_POST['tarif']){
    echo $IDProduit;
}
?>