<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$columns = '';
$values = '';
if ($_POST['IDChantier'] != '') {
    $retour_exist = $base->query("SELECT *
    FROM chantier
    WHERE IDChantier = '".$_POST['IDChantier']."'");
    while ($data_exist = $retour_exist->fetch()){
        $columns = ", adresse, telephone, gsm, email";
        $values = ", '".$data_exist['adresse']."', '".$data_exist['telephone']."', '".$data_exist['gsm']."', '".$data_exist['email']."'";
    }
}
$requete = "INSERT INTO chantier
(client, chantier, statut".$columns.", createur, creation)
VALUES ('".$_POST['client']."', '".$_POST['chantier']."', '".$_POST['statut']."'".$values.", '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_chantier = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
$retournewchantier = $base->query("SELECT MAX(IDChantier) As maxi
FROM chantier");
while ($datanewchantier = $retournewchantier->fetch()){
    echo $IDChantier = $datanewchantier['maxi'];
}

/*ACTION SYSTEME*/
$requete = "INSERT INTO actions
(IDChantier, type, date, commentaire, createur, creation)
VALUES ('".$IDChantier."', 'Système', '".date('Y-m-d H:i:s')."'
, 'Création du chantier'
, '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_titre = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>