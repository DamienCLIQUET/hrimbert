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
        color: white;'>Filtrer par points</div>
        <i class='fa-regular fa-rectangle-xmark fa-xl' style='color: red; margin-right: 10px;' onclick='fermer_point()'></i>
    </div>
    <div id='menu_points' style='margin: 5px;
    font-size: 18px;
    overflow-y: scroll;
    overflow-x: hidden;'>
        <?php
        $maxPoint = '0';
        $IDChantier = $_POST['IDChantier'];
        $IDPlan = $_POST['IDPlan'];
        $retourpoint = $base->query("SELECT points.IDPoint, points.nbpoint, points.x, points.y, points.nompoint, etats.nomEtat
        , etats.colorEtat, familles.nomFamille
        FROM points
        LEFT JOIN etats
        ON etats.IDEtat = points.IDEtat
        LEFT JOIN familles
        ON familles.IDFamille = points.IDFamille
        WHERE points.IDChantier = '".$IDChantier."' AND points.IDPlan = '".$IDPlan."'
        ORDER BY points.nbpoint");
        while ($datapoint = $retourpoint->fetch()){
            $IDPoint = $datapoint['IDPoint'];
            $colorEtat = $datapoint['colorEtat'];
            $nompoint = $datapoint['nompoint'];
            if ($maxPoint < $IDPoint){
                $maxPoint = $IDPoint;
            }
            $liste = explode(',', $_POST['liste_points']);
            if (in_array($IDPoint, $liste)) {
                $check = 'checked';
            } else {
                $check = '';
            }
            ?>
            <div>
                <input type="checkbox" id='checkIDPoint<?php echo $IDPoint; ?>' <?php echo $check; ?> class='checkpoints'
                onchange='check_point()'>
                <label for='checkIDPoint<?php echo $IDPoint; ?>'>
                    <i class='fa-solid fa-location-dot' style='color: <?php echo $colorEtat; ?>;'></i><?php echo $nompoint; ?>
                </label>
            </div>
            <?php
        }
        ?>
        <input type="hidden" id='maxPoint' value='<?php echo $maxPoint; ?>'>
    </div>
    <div style='margin-bottom: 5px; display: flex; justify-content: space-evenly;'>
        <input type="button" value='Cocher tout' class='styled' style='padding: 2px 10px;'
        onclick='check_tout("points")'>
        <input type="button" value='Décocher tout' class='styled' style='padding: 2px 10px;'
        onclick='uncheck_tout("points")'>
    </div>
    <div style='width: 100%; display: flex; align-items: center; justify-content: center; height: 30px;'>
        <i class='fa-solid fa-print fa-xl' title='Rapport'
        onclick='print_rapport("<?php echo $IDChantier; ?>", "<?php echo $IDPlan; ?>")'></i>
    </div>
</div>