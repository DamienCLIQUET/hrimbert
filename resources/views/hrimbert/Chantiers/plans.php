<?php
session_start();
include('../config.php');

if ($_SESSION["VoirPlanhr"] == '1') {
    $IDChantier = $_POST['IDChantier'];
    $extension = 'jpg';
    if (empty($_POST['IDPlan'])){
        if (file_exists('../Plans/'.$IDChantier)) {
            $IDPlan = 999999;
            $scandir = scandir('../Plans/'.$IDChantier."/");
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
                    if ($IDPlan > basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION))){
                        $IDPlan = basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION));
                        $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                    }
                }
            }
        
        } else {
            $IDPlan = '1';
        }
    } else {
        $IDPlan = $_POST['IDPlan'];
        if (file_exists('../Plans/'.$IDChantier)) {
            $nom_fichier = 999999;
            $scandir = scandir('../Plans/'.$IDChantier."/");
            foreach($scandir as $fichier){
                if ($IDPlan == basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION))){
                    $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                }
            }
        }
    }
    if (file_exists('../Plans/'.$IDChantier.'/'.$IDPlan.'.'.$extension)) {
        list($width, $height, $type, $attr) = getimagesize('../Plans/'.$IDChantier.'/'.$IDPlan.'.'.$extension);
        ?>
        <div class='chantier_details_menu'>
            <i class='fa-solid fa-map-location-dot fa-xl picto'
            onclick='ouvrir_menu("menu_plans", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-location-dot fa-xl picto'
            onclick='ouvrir_menu("menu_points", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-lg fondfiltre picto'
            onclick='ouvrir_menu("menu_points", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-xs filtre picto'
            onclick='ouvrir_menu("menu_points", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-screwdriver-wrench fa-xl picto'
            onclick='ouvrir_menu("menu_etats", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-lg fondfiltre picto'
            onclick='ouvrir_menu("menu_etats", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-xs filtre picto'
            onclick='ouvrir_menu("menu_etats", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-tags fa-xl picto'
            onclick='ouvrir_menu("menu_familles", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-lg fondfiltre picto'
            onclick='ouvrir_menu("menu_familles", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
            <i class='fa-solid fa-filter fa-xs filtre picto'
            onclick='ouvrir_menu("menu_familles", <?php echo $IDChantier; ?>, <?php echo $IDPlan; ?>)'></i>
        </div>
        <div id='chantier_details_plan'>
            <input type="hidden" id="IDChantier" value="<?php echo $IDChantier; ?>"/>
            <input type="hidden" id="IDPlan" value="<?php echo $IDPlan; ?>"/>
            <input type="hidden" id="mouseclicx"/>
            <input type="hidden" id="mouseclicy"/>
            <input type="hidden" id="dernierpoint" value="0"/>
            <input type="hidden" id="mousedebutx"/>
            <input type="hidden" id="mousedebuty"/>
            <input type="hidden" id="taillephoto" value="<?php echo $height / $width; ?>"/>
            <div id="chantier_details_plan_canvas"
            style="width: <?php echo $width; ?>px;
                height: <?php echo $height; ?>px;
                background-image: url('../Plans/<?php echo $IDChantier."/".$IDPlan.".".$extension; ?>');"
            ondblclick="menu_point(0)">
            </div>
        </div>
        <div id='cadre_position'
        style="background-image: url('../Plans/<?php echo $IDChantier."/".$IDPlan.".".$extension; ?>');">;

        </div>
        <div id='cadre_rouge'>

        </div>
        <div id='chantier_details_point' style=''>

        </div>
        <?php
    } else {
        ?>
        <div id='pas_plan'
        onclick='parcourir_plan(<?php echo $IDChantier; ?>)'>
            <i class='fa-solid fa-map fa-2xl'></i>
            <i class='fa-solid fa-circle picto_fond'></i>
            <i class='fa-regular fa-circle picto_cercle'></i>
            <i class='fa-solid fa-plus fa-2xs picto_plus'></i>
        </div>
        <input type='file' id='fichier_plan<?php echo $IDChantier; ?>' accept='image/*'
        style='display: none;'>
        <?php
    }
}
?>