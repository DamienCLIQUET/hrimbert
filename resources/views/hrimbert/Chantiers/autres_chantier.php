<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

$categorie = '25';
$total_categorie = 0;
$retourchantier = $base->query("SELECT IDChantier, client, chantier, tva
FROM chantier
WHERE statut = '".$categorie."'
ORDER BY client");
while ($datachantier = $retourchantier->fetch()){
    $IDChantier = $datachantier['IDChantier'];
    $Label_client = $datachantier['client'];
    $Label_chantier = $datachantier['chantier'];
    $tva = $datachantier['tva'];
    $retour_avancement_chantier = $base->query("SELECT (SUM(avancement) / COUNT(quantite)) As avancement, SUM(quantite * tarif * (100 - remise) / 100) As total
    FROM details_chantier
    WHERE IDChantier = '".$IDChantier."'");
    while ($data_avancement_chantier = $retour_avancement_chantier->fetch()){
        $avancement_total = $data_avancement_chantier['avancement'];
        $total_chantier = $data_avancement_chantier['total'];
        $total_categorie += $data_avancement_chantier['total'];
    }
    echo "<div class='quelchantier ".$Label_client." ".$Label_chantier."'>";
    echo "<form method='get' action='Chantiers/chantier.php'>";
        echo "<input type='hidden' name='IDChantier' value='".$IDChantier."'>";
        /*Si categorie en cours afficher état d'avancement*/
        if ($categorie == '7') {
            echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."' style='background: linear-gradient(90deg, #8aff8a ".$avancement_total."%, white 0%);'>";
        } else {
            echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."'>";
        }
    echo "</form>";
    /*Si autorisé à voir action*/
    if ($_SESSION["VoirActionhr"] == '1'){
        $retouraction = $base->query("SELECT type, date, commentaire
        FROM actions
        WHERE IDChantier = '".$IDChantier."' ORDER BY date DESC LIMIT 1");
        while ($dataaction = $retouraction->fetch()){
            echo "<div class='action'>";
            echo "<i class='fa-solid fa-calendar-minus fa-xs'></i>";
            echo "<a class='action_action'>".date('d/m/y', strtotime($dataaction['date']))." ".$dataaction['type']." : ".htmlspecialchars($dataaction['commentaire'], ENT_QUOTES)."</a>";
            /*Si autorisé à voir tarif action*/
            if ($_SESSION["VoirTarifhr"] == '1'){
                echo "<a class='action_tarif'>".intval($total_chantier * (100 + floatval($tva)) / 100)."€ TTC</a>";
            }
            echo "</div>";
        }
    }
    echo "</div>";
}