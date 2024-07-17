<?php
include('../config.php');
date_default_timezone_set('Europe/Paris');
session_start();

$description = htmlspecialchars($_POST['description'], ENT_QUOTES);
$IDProduit = $_POST['IDProduit'];
if (trim($description) != '') {
    $requete = "UPDATE produits
    SET description = '".$description."'
    WHERE IDProduit = '".$IDProduit."'";
    $retour_description_produit = $base->query($requete);
    $save = $base->query("INSERT INTO historique
    (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
}
?>