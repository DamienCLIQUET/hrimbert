<?php
session_start();
include('../config.php');

/*$user = $_SESSION['user'];*/
$user = 'DCLIQUET';
$date = $_POST['date'];
if (strlen($_POST['debutMatin']) < 8){
    $debutMatin = $_POST['debutMatin'].":00";
} else {
    $debutMatin = $_POST['debutMatin'];
}
if (strlen($_POST['finMatin']) < 8){
    $finMatin = $_POST['finMatin'].":00";
} else {
    $finMatin = $_POST['finMatin'];
}
if (strlen($_POST['debutSoir']) < 8){
    $debutSoir = $_POST['debutSoir'].":00";
} else {
    $debutSoir = $_POST['debutSoir'];
}
if (strlen($_POST['finSoir']) < 8){
    $finSoir = $_POST['finSoir'].":00";
} else {
    $finSoir = $_POST['finSoir'];
}
$retour_existe = $base->query("SELECT ID
FROM heures
WHERE user = '".$user."' AND date = '".$date."'");
if ($retour_existe->fetch() != false){
    $requete = "UPDATE heures
    SET debutMatin = '".$debutMatin."', finMatin = '".$finMatin."', debutSoir = '".$debutSoir."', finSoir = '".$finSoir."'
    WHERE user = '".$user."' AND  date = '".$date."'";
    $retour_exist = $base->query($requete);
    $save = $base->query("INSERT INTO historique (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");

} else {
    $requete = "INSERT INTO heures
    (user, date, debutMatin, finMatin, debutSoir, finSoir)
    VALUES ('".$user."', '".$date."', '".$debutMatin."', '".$finMatin."', '".$debutSoir."', '".$finSoir."')";
    $retour_exist = $base->query($requete);
    $save = $base->query("INSERT INTO historique (user, date, action)
    VALUES ('".$_SESSION['userhr']."', '".date('Y-m-d H:i:s')."', '".str_replace('\'', '', $requete)."')");
}
?>