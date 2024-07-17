<?php
session_start();
include('../config.php');

$IDChantier = $_POST['IDChantier'];
?>
<div style='display: flex;
position: fixed;
width: 300px;
height: 100vh;
top: 0;
left: 0;
background-color: white;
flex-direction: column;
justify-content: flex-start;
align-items: center;
border: solid 1px black;'>
    <div style='display: flex;
    flex-wrap: nowrap;
    align-items: center;
    justify-content: flex-end;
    width: 100%;
    height: 45px;
    background-color: rgb(21, 114, 185);';>
        <div style='display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-size: 25px;
        color: white;'>Liste des plans</div>
        <i class='fa-regular fa-rectangle-xmark fa-xl' style='color: red; margin-right: 10px;' onclick='fermer_point()'></i>
    </div>
    <div style='display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;'
    onclick='parcourir_plan(<?php echo $IDChantier; ?>)'>
        <i class='fa-solid fa-map fa-2xl'></i>
        <i class='fa-solid fa-circle picto_fond'></i>
        <i class='fa-regular fa-circle picto_cercle'></i>
        <i class='fa-solid fa-plus fa-2xs picto_plus'></i>
    </div>
    <input type='file' id='fichier_plan<?php echo $IDChantier; ?>' accept='image/*'
    style='display: none;'>
    <div id='menu_plans' style='font-size: 18px;
    overflow-y: scroll;
    overflow-x: hidden;'>
        <?php
        if (file_exists($IDChantier."/") != false) {
            $scandir = scandir($IDChantier."/");
            foreach($scandir as $fichier){
                if (substr($fichier, 0, 1) != '.'
                AND (pathinfo($fichier, PATHINFO_EXTENSION) == "jpg"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "png"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "PNG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "jpeg"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPEG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "gif"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "GIF")){
                    $nom_fichier = basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION));
                    ?>
                    <div style='width: 300px;
                    height: 200px;
                    border-bottom: dotted 3px rgb(21, 114, 185);
                    background-size: cover;
                    background-position: center;
                    background-image: url("../Plans/<?php echo $IDChantier; ?>/<?php echo $fichier; ?>");
                    background-repeat: no-repeat;'
                    onclick='charger_plan(<?php echo $IDChantier; ?>, <?php echo $nom_fichier; ?>)'>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>