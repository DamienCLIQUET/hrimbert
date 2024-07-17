<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$unite = htmlspecialchars($_POST['unite'], ENT_QUOTES);
$IDProduit = $_POST['IDProduit'];
if (trim($unite) != '') {
    $requete = "UPDATE produits
    SET unite = '".$unite."'
    WHERE IDProduit = '".$IDProduit."'";
    $retour_unite_produit = $base->query($requete);
    $save = $base->query("INSERT INTO historique
    (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
}
?>