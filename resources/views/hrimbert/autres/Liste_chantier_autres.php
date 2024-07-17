<?php
    include('config.php');
    session_start();

    $categorie = $_POST['categorie'];
    $label_categorie = 'chantier';  
    $retourchantier = $base->query("SELECT chantier.IDChantier, chantier.client, chantier.chantier, chantier.tva, chantier.statut, categories.type
    FROM chantier
    LEFT JOIN categories
    ON chantier.statut = categories.IDType
    WHERE statut = '".$categorie."'
    ORDER BY client");
    $total_categorie = 0;
    while ($datachantier = $retourchantier->fetch()){
        $IDChantier = $datachantier['IDChantier'];
        $Label_client = $datachantier['client'];
        $Label_chantier = $datachantier['chantier'];
        $tva = $datachantier['tva'];
        $label_categorie = $datachantier['type'];
        $retour_avancement_chantier = $base->query("SELECT SUM(avancement) / COUNT(quantite) As avancement, SUM(quantite * tarif * (100 - remise) / 100) As total
        FROM details
        WHERE IDChantier = '".$IDChantier."' AND actif = '1'");
        while ($data_avancement_chantier = $retour_avancement_chantier->fetch()){
            $avancement_total = $data_avancement_chantier['avancement'];
            $total_chantier = $data_avancement_chantier['total'];
            $total_categorie += $data_avancement_chantier['total'];
        }
        echo "<form name='chantier' method='get' action='Chantier.php'>";
            echo "<input type='hidden' name='IDType' value='".$categorie."'>";
            echo "<input type='hidden' name='IDChantier' value='".$IDChantier."'>";
            if ($categorie == '7') {
                echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."' style='background: linear-gradient(90deg, #8aff8a ".$avancement_total."%, white 0%);'>";
            } else {
                echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."'>";
            }
        echo "</form>";
        if ($_SESSION["VoirAction".$categorie."hr"] == '1'){
            $retouraction = $base->query("SELECT type, date, commentaire
            FROM actions
            WHERE IDChantier = '".$IDChantier."' ORDER BY date DESC LIMIT 1");
            while ($dataaction = $retouraction->fetch()){
                echo "<div style='display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: nowrap;
                margin: 0 2px 5px 2px;'>";
                echo "<i class='fa-solid fa-calendar-minus fa-2xs' style='margin-left: 5px;'></i>";
                echo "<a style='font-size: 0.8rem; flex-grow: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-left: 5px;'>".date('d/m/y', strtotime($dataaction['date']))." ".$dataaction['type']." -".htmlspecialchars($dataaction['commentaire'], ENT_QUOTES)."</a>";
                if ($_SESSION["VoirTarifAction".$categorie."hr"] == '1'){
                    echo "<a style='font-size: 0.8rem; margin-left: 5px; white-space: nowrap;'>".intval($total_chantier * (100 + floatval($tva)) / 100)."€ TTC</a>";
                }
                echo "</div>";
            }
        }
    }
    echo "<center style='display: flex; align-items: center; justify-content: center; font-size: 25px;'>";
    if ($_SESSION["AjoutCategorie".$categorie."hr"] == '1'){
        echo "<center style='display: flex; align-items: center; justify-content: center; font-size: 25px;'><input type='image' value='' src='Images/Plus.png' title='Ajouter un ".$label_categorie."' class='plus'>";
    }
    if ($_SESSION["VoirTarifTotal".$categorie."hr"] == '1'){
        echo intval($total_categorie)."€ HT";
    }
    echo "</center>";
?>