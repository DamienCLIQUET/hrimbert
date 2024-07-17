<?php
session_start();
include('../config.php');

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
        color: white;'>Filtrer par états</div>
        <i class='fa-regular fa-rectangle-xmark fa-xl' style='color: red; margin-right: 10px;' onclick='fermer_point()'></i>
    </div>
    <div id='menu_etats' style='margin: 5px;
    font-size: 18px;
    overflow-y: scroll;
    overflow-x: hidden;'>
        <?php
        $maxEtat = '0';
        $IDChantier = $_POST['IDChantier'];
        $IDPlan = $_POST['IDPlan'];
        $retour_etats = $base->query("SELECT *
        FROM etats");
        while ($data_etats = $retour_etats->fetch()){
            $IDEtat = $data_etats['IDEtat'];
            $nomEtat = $data_etats['nomEtat'];
            $colorEtat = $data_etats['colorEtat'];
            if ($maxEtat < $IDEtat){
                $maxEtat = $IDEtat;
            }
            $liste = explode(',', $_POST['liste_etats']);
            if (in_array($IDEtat, $liste)) {
                $check = '';
            } else {
                $check = 'checked';
            }
            ?>
            <div>
                <input type="checkbox" id='checkIDEtat<?php echo $IDEtat; ?>' <?php echo $check; ?> class='checketats'
                onchange='check_etat()'>
                <label for='checkIDEtat<?php echo $IDEtat; ?>'>
                    <i class='fa-solid fa-location-dot' style='color: <?php echo $colorEtat; ?>;'>
                    </i><?php echo $nomEtat; ?>
                </label>
            </div>
            <?php
        }
        ?>
        <input type="hidden" id='maxEtat' value='<?php echo $maxEtat; ?>'>
    </div>
    <div style='margin-bottom: 5px; display: flex; justify-content: space-evenly;'>
        <input type="button" value='Cocher tout' class='styled' style='padding: 2px 10px;'
        onclick='check_tout("etats")'>
        <input type="button" value='Décocher tout' class='styled' style='padding: 2px 10px;'
        onclick='uncheck_tout("etats")'>
    </div>
    <div style='width: 100%; display: flex; align-items: center; justify-content: center; height: 30px;'>
        <i class='fa-solid fa-print fa-xl' title='Rapport'
        onclick='print_rapport("<?php echo $IDChantier; ?>", "<?php echo $IDPlan; ?>")'></i>
    </div>
</div>