<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

echo $IDDetailsproduit = $_POST['IDDetails'];
echo "<br>";
echo $IDChantier = $_POST['IDChantier'];
echo "<br>";
echo $IDTitre = $_POST['IDTitre'];
echo "<br>";
echo $IDPosition = $_POST['IDPosition'];
echo "<br>";
$retourpositions = $base->query("SELECT details_chantier.IDDetails
FROM details_chantier
WHERE IDChantier = '".$IDChantier."' AND IDTitre = '".$IDTitre."' AND IDPosition > '".$IDPosition."'
ORDER BY details_chantier.IDPosition");
$iposition = $IDPosition + 1;
$inewposition = $IDPosition + 1;
while ($datapositions = $retourpositions->fetch()){
    $IDDetails = $datapositions['IDDetails'];
    if ($IDDetails != $IDDetailsproduit){
        $iposition++;
        echo "1 - ".$requete = "UPDATE details_chantier
        SET IDPosition = '".$iposition."'
        WHERE IDDetails = '".$IDDetails."'";
        echo "<br>";
        $retour_exist = $base->query($requete);
        $save = $base->query("INSERT INTO historique (user, date, action)
        VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
    }
}
echo "2 - ".$requete = "UPDATE details_chantier
SET IDPosition = '".$inewposition."'
, IDTitre = '".$IDTitre."'
WHERE IDDetails = '".$IDDetailsproduit."'";
echo "<br>";
$retour_exist = $base->query($requete);
$save = $base->query("INSERT INTO historique (user, date, action)
VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>