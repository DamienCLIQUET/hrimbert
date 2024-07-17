<?php
    include('config.php');
    session_start();
    date_default_timezone_set('Europe/Paris');

    $retour_connect = $base->query("SELECT utilisateurs.profil
    , profils.designation
    , profils.VoirMenuProduits
    , profils.VoirMenuParametres
    , profils.VoirCategorie1
    , profils.VoirCategorie2
    , profils.VoirCategorie3
    , profils.VoirCategorie4
    , profils.VoirCategorie5
    , profils.VoirCategorie6
    , profils.VoirCategorie7
    , profils.VoirCategorie8
    , profils.VoirCategorie9
    , profils.VoirCategorie10
    , profils.VoirCategorie20
    , profils.VoirCategorie25
    , profils.AjoutCategorie1
    , profils.AjoutCategorie2
    , profils.AjoutCategorie3
    , profils.AjoutCategorie4
    , profils.AjoutCategorie5
    , profils.AjoutCategorie6
    , profils.AjoutCategorie7
    , profils.AjoutCategorie8
    , profils.AjoutCategorie9
    , profils.AjoutCategorie10
    , profils.AjoutCategorie20
    , profils.AjoutCategorie25
    , profils.VoirAction
    , profils.VoirTarif
    , profils.VoirAdmin
    , profils.VoirPlan
    , profils.ModifCategorie
    FROM utilisateurs
    LEFT JOIN profils
    ON profils.profil = utilisateurs.profil
    WHERE userhr = '".$_POST['userhr']."' AND passhr = '".$_POST['passhr']."'");
    while ($data_connect = $retour_connect->fetch()) {
        if ($data_connect['profil'] > 0){
            $_SESSION["userhr"] = $_POST['userhr'];
            $_SESSION["passhr"] = $_POST['passhr'];
            $_SESSION["profilhr"] = $data_connect['profil'];
            $_SESSION["designationhr"] = $data_connect['designation'];
            $_SESSION["VoirMenuProduitshr"] = $data_connect['VoirMenuProduits'];
            $_SESSION["VoirMenuParametreshr"] = $data_connect['VoirMenuParametres'];
            $_SESSION["VoirCategorie1hr"] = $data_connect['VoirCategorie1'];
            $_SESSION["VoirCategorie2hr"] = $data_connect['VoirCategorie2'];
            $_SESSION["VoirCategorie3hr"] = $data_connect['VoirCategorie3'];
            $_SESSION["VoirCategorie4hr"] = $data_connect['VoirCategorie4'];
            $_SESSION["VoirCategorie5hr"] = $data_connect['VoirCategorie5'];
            $_SESSION["VoirCategorie6hr"] = $data_connect['VoirCategorie6'];
            $_SESSION["VoirCategorie7hr"] = $data_connect['VoirCategorie7'];
            $_SESSION["VoirCategorie8hr"] = $data_connect['VoirCategorie8'];
            $_SESSION["VoirCategorie9hr"] = $data_connect['VoirCategorie9'];
            $_SESSION["VoirCategorie10hr"] = $data_connect['VoirCategorie10'];
            $_SESSION["VoirCategorie20hr"] = $data_connect['VoirCategorie20'];
            $_SESSION["VoirCategorie25hr"] = $data_connect['VoirCategorie25'];
            $_SESSION["AjoutCategorie1hr"] = $data_connect['AjoutCategorie1'];
            $_SESSION["AjoutCategorie2hr"] = $data_connect['AjoutCategorie2'];
            $_SESSION["AjoutCategorie3hr"] = $data_connect['AjoutCategorie3'];
            $_SESSION["AjoutCategorie4hr"] = $data_connect['AjoutCategorie4'];
            $_SESSION["AjoutCategorie5hr"] = $data_connect['AjoutCategorie5'];
            $_SESSION["AjoutCategorie6hr"] = $data_connect['AjoutCategorie6'];
            $_SESSION["AjoutCategorie7hr"] = $data_connect['AjoutCategorie7'];
            $_SESSION["AjoutCategorie8hr"] = $data_connect['AjoutCategorie8'];
            $_SESSION["AjoutCategorie9hr"] = $data_connect['AjoutCategorie9'];
            $_SESSION["AjoutCategorie10hr"] = $data_connect['AjoutCategorie10'];
            $_SESSION["AjoutCategorie20hr"] = $data_connect['AjoutCategorie20'];
            $_SESSION["AjoutCategorie25hr"] = $data_connect['AjoutCategorie25'];
            $_SESSION["VoirActionhr"] = $data_connect['VoirAction'];
            $_SESSION["VoirTarifhr"] = $data_connect['VoirTarif'];
            $_SESSION["VoirAdminhr"] = $data_connect['VoirAdmin'];
            $_SESSION["VoirPlanhr"] = $data_connect['VoirPlan'];
            $_SESSION["ModifCategoriehr"] = $data_connect['ModifCategorie'];
            $save = $base->query("INSERT INTO historique (user, date, action) VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', 'Connection')");

            echo "Ok";
        } else {
            echo "No";
        }
    }
?>