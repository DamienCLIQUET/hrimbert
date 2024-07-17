<?php
    session_start();
    include('../config.php');

    $filtre = '';
    $IDChantier = $_POST['IDChantier'];
    $IDPlan = $_POST['IDPlan'];
    if(isset($_POST['filtre'])) {
        $filtre = $_POST['filtre'];
    }
    $table = array();
    $retourpoint = $base->query("SELECT points.IDPoint, points.nbpoint, points.x, points.y, points.nompoint, points.IDEtat, points.IDFamille, etats.nomEtat, etats.colorEtat, familles.nomFamille
    FROM points
    LEFT JOIN etats
    ON etats.IDEtat = points.IDEtat
    LEFT JOIN familles
    ON familles.IDFamille = points.IDFamille
    WHERE points.IDChantier = '".$IDChantier."' AND points.IDPlan = '".$IDPlan."'".$filtre."
    ORDER BY points.nbpoint");
    $i = 0;
    while ($datapoint = $retourpoint->fetch()){
        $table[$i] = ['IDPoint' => $datapoint['IDPoint']
        , 'nbpoint' => $datapoint['nbpoint']
        , 'x' => $datapoint['x']
        , 'y' => $datapoint['y']
        , 'IDEtat' => $datapoint['IDEtat']
        , 'IDFamille' => $datapoint['IDFamille']
        , 'colorEtat' => $datapoint['colorEtat']];
        $i++;
    }
    echo json_encode($table);
?>