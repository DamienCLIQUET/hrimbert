<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$tarif = $_POST['tarif'];
$IDProduit = $_POST['IDProduit'];
if (trim($tarif) != '' AND $tarif != 0) {
    $requete = "UPDATE produits
    SET tarif = '".$tarif."'
    WHERE IDProduit = '".$IDProduit."'";
    $retour_tarif_base_produit = $base->query($requete);
    $save = $base->query("INSERT INTO historique
    (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
}
?>