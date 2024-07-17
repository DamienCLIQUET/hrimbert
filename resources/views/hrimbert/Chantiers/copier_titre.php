<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$IDChantier = $_POST['IDChantier'];
$IDTitre = $_POST['IDTitre'];
$retourtitres_chantier = $base->query("SELECT *
FROM titres_chantier
WHERE IDChantier = '".$IDChantier."' AND IDTitre = '".$IDTitre."'");
while ($datatitres_chantier = $retourtitres_chantier->fetch()){
    $retournewtitres = $base->query("SELECT MAX(IDTitre) As maxititres
    FROM titres_chantier");
    while ($datanewtitres = $retournewtitres->fetch()){
        $newIDtitres = $datanewtitres['maxititres'] + 1;
    }
    $retournewposition = $base->query("SELECT MAX(IDPosition) As maxiposition
    FROM titres_chantier
    WHERE IDChantier = '".$IDChantier."'");
    while ($datanewposition = $retournewposition->fetch()){
        $newIDposition = $datanewposition['maxiposition'] + 1;
    }
    $requetetitres_chantier = "INSERT INTO titres_chantier
    (IDTitre, IDChantier, IDPosition, titre, createur, creation, modifieur, modification)
    VALUES ('".$newIDtitres."', '".$IDChantier."', '".$newIDposition."', 'COPIE de ".htmlspecialchars($datatitres_chantier['titre'], ENT_QUOTES)."'
    , '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."', '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
    $inserttitres_chantier = $base->query($requetetitres_chantier);
    $save = $base->query("INSERT INTO historique (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetetitres_chantier)."')");
    $retourdetails_chantier = $base->query("SELECT *
    FROM details_chantier
    WHERE IDChantier = '".$IDChantier."' AND IDTitre = '".$IDTitre."'");
    while ($datadetails_chantier = $retourdetails_chantier->fetch()){
        $requetedetails_chantier = "INSERT INTO details_chantier
        (IDChantier, IDProduit, IDTitre, IDPosition, quantite, tarif, remise, avancement, commentaires, createur, creation, modifieur, modification)
        VALUES ('".$IDChantier."', '".$datadetails_chantier['IDProduit']."', '".$newIDtitres."'
        , '".$datadetails_chantier['IDPosition']."', '".$datadetails_chantier['quantite']."', '".$datadetails_chantier['tarif']."'
        , '".$datadetails_chantier['remise']."', '".$datadetails_chantier['avancement']."', '".htmlspecialchars($datadetails_chantier['commentaires'], ENT_QUOTES)."'
        , '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."', '".$_SESSION["userhr"]."', '".date('Y-m-d H:i:s')."')";
        $insertdetails_chantier = $base->query($requetedetails_chantier);
        $save = $base->query("INSERT INTO historique (user, date, action)
        VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requetedetails_chantier)."')");
    }
}
?>