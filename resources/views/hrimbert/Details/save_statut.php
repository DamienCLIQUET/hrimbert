<?php
session_start();
include('../config.php');

$requete = "UPDATE chantier
SET statut = '".$_POST['statut']."'
WHERE IDChantier = '".$_POST['IDChantier']."'";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
/*ACTION SYSTEME*/
$retourcategorie = $base->query("SELECT type
FROM categories
WHERE IDType = '".$_POST['statut']."'");
while ($datacategorie = $retourcategorie->fetch()){
    echo $type = htmlspecialchars(str_replace('\'', '\\\'', $datacategorie['type']), ENT_QUOTES);
}
echo $requete = "INSERT INTO actions
(IDChantier, type, date, commentaire, createur, creation)
VALUES ('".$_POST['IDChantier']."', 'Système', '".date('Y-m-d H:i:s')."'
, 'Statut ".$type."'
, '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
$insert_titre = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>