<?php
    session_start();
    include('../config.php');

    if (isset($_POST['IDChantier']) == false){
        $IDPoint = $_POST['IDPoint'];
        $nompoint = $_POST['nompoint'];
        $IDEtat = $_POST['IDEtat'];
        $commentaires = htmlspecialchars($_POST['commentaires'], ENT_QUOTES);
    
        if ($_POST['IDFamille'] != 0){
            $IDFamille = $_POST['IDFamille'];
        } else {
            if ($_POST['labelFamille'] != ''){
                $requete = "INSERT INTO familles (nomFamille)
                VALUES ('".$_POST['labelFamille']."')";
                $insert_familles = $base->query($requete);
                $retour_IDFamille = $base->query("SELECT IDFamille
                FROM familles
                WHERE nomFamille = '".$_POST['labelFamille']."'");
                while ($data_IDFamille = $retour_IDFamille->fetch()){
                    $IDFamille = $data_IDFamille['IDFamille'];
                }
            } else {
                $IDFamille = '0';
            }
        }
        $requete = "UPDATE points
        SET nompoint = '".$nompoint."', IDEtat = '".$IDEtat."', IDFamille = '".$IDFamille."', commentaires = '".str_replace('\'', '\\\'', $commentaires)."'
        WHERE IDPoint = '".$IDPoint."'";
        $retour_tarif_produit = $base->query($requete);
        $save = $base->query("INSERT INTO historique (user, date, action)
        VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
    } else {
        $IDChantier = $_POST['IDChantier'];
        $IDPlan = $_POST['IDPlan'];
        $x = $_POST['x'];
        $y = $_POST['y'];
        $nbpoint = $_POST['nbpoint'];
        $nompoint = $_POST['nompoint'];
        $IDEtat = $_POST['IDEtat'];
        $commentaires = htmlspecialchars($_POST['commentaires'], ENT_QUOTES);
    
        if ($_POST['IDFamille'] != 0){
            $IDFamille = $_POST['IDFamille'];
        } else {
            if ($_POST['labelFamille'] != ''){
                $requete = "INSERT INTO familles (nomFamille)
                VALUES ('".$_POST['labelFamille']."')";
                $insert_familles = $base->query($requete);
                $retour_IDFamille = $base->query("SELECT IDFamille
                FROM familles
                WHERE nomFamille = '".$_POST['labelFamille']."'");
                while ($data_IDFamille = $retour_IDFamille->fetch()){
                    $IDFamille = $data_IDFamille['IDFamille'];
                }
            } else {
                $IDFamille = '0';
            }
        }
        $requete = "INSERT INTO points (IDChantier, IDPlan, x, y, nbpoint, nompoint, IDEtat, IDFamille, commentaires)
        VALUES ('".$IDChantier."', '".$IDPlan."', '".$x."', '".$y."', '".$nbpoint."', '".$nompoint."', '".$IDEtat."', '".$IDFamille."', '".$commentaires."')";
        $retour_tarif_produit = $base->query($requete);
        $save = $base->query("INSERT INTO historique (user, date, action)
        VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
    }
?>