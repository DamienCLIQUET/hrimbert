<?php
session_start();
include('../config.php');

$IDPoint = $_POST['IDPoint'];

if ($IDPoint == 0){
    $nbpoint = 'Nouveau point';
    $nompoint = '';
    $IDEtat = 0;
    $IDFamille = 0;
} else {
    $retour_point = $base->query("SELECT *
    FROM points
    WHERE points.IDPoint = '".$IDPoint."'");
    while ($data_point = $retour_point->fetch()){
        $nbpoint = $data_point['nbpoint'];
        $nompoint = $data_point['nompoint'];
        $IDEtat = $data_point['IDEtat'];
        $IDFamille = $data_point['IDFamille'];
    }
}
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
        color: white;'><?php echo $nbpoint; ?></div>
        <i class='fa-regular fa-rectangle-xmark fa-xl' style='color: red; margin-right: 10px;' onclick='fermer_point()'></i>
    </div>
    <p style='width: 100%; margin: 20px 2px 2px 2px;'>Nom du point :</p>
    <input type='text' id='nompoint' value='<?php echo $nompoint; ?>' style='width: calc(100% - 8px); margin: 2px;'>
    <p style='width: 100%; margin: 20px 2px 2px 2px;'>Etat du point : </p>
    <div style='width: calc(100% - 8px); margin: 20px 2px 2px 2px;'>
        <?php
        $retour_etats = $base->query("SELECT *
        FROM etats");
        while ($data_etats = $retour_etats->fetch()){
            ?>
            <div>
                <input type='radio' id='<?php echo $data_etats['IDEtat']; ?>' name='etat' value='<?php echo $data_etats['IDEtat']; ?>'
                <?php
                if ($data_etats['IDEtat'] == $IDEtat){
                ?>
                    checked
                <?php
                }
                ?>
                >
                <label for='<?php echo $data_etats['IDEtat']; ?>'>
                    <i class='fa-solid fa-location-dot' style='color: <?php echo $data_etats['colorEtat']; ?>;'></i><?php echo $data_etats['nomEtat']; ?></label>
            </div>
            <?php
        }
        ?>
    </div>
    <p style='width: 100%; margin: 20px 2px 2px 2px;'>Catégorie :</p>
    <div style='width: calc(100% - 8px); margin: 20px 2px 2px 2px;'>
        <div>
            <input type='radio' id='0' name='famille' value='0'>
            <label for='0'><input type='text' id='labelFamille' value=''></label>
        </div>
        <?php
        $retour_familles = $base->query("SELECT *
        FROM familles");
        while ($data_familles = $retour_familles->fetch()){
            ?>
            <div>
                <input type='radio' id='<?php echo $data_familles['IDFamille']; ?>' name='famille' value='<?php echo $data_familles['IDFamille']; ?>'
                <?php
                if ($data_familles['IDFamille'] == $IDFamille){
                ?>
                    checked
                <?php
                }
                ?>
                >
                <label for='<?php echo $data_familles['IDFamille']; ?>'><?php echo $data_familles['nomFamille']; ?></label>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    if ($IDPoint == 0){
        ?>
        <input type='button' value='Créer le point' onclick='creer_point()'>
        <?php
    }
    ?>
</div>