<?php
    session_start();
    include('../config.php');

    $requete = "UPDATE chantier
    SET adresse = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['adresse']), ENT_QUOTES)."'
    , telephone = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['telephone']), ENT_QUOTES)."'
    , gsm = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['gsm']), ENT_QUOTES)."'
    , email = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['email']), ENT_QUOTES)."'
    , commentaire = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['commentaire']), ENT_QUOTES)."'
    , administratif = '".htmlspecialchars(str_replace('\'', '\\\'', $_POST['administratif']), ENT_QUOTES)."'
    , paye = '".$_POST['paye']."'
    , tva = '".$_POST['tva']."'
    , modifieur = '".$_SESSION['userhr']."'
    , modification = '".date('Y-m-d H:i:s')."'
    WHERE IDChantier = '".$_POST['IDChantier']."'";
    $retour_exist = $base->query($requete);
    $save = $base->query("INSERT INTO historique (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
?>