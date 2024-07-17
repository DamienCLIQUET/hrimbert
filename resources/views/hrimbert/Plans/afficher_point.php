<?php
session_start();
include('../config.php');

$IDPoint = $_POST['IDPoint'];

if ($IDPoint == 0){
    $nbpoint = 'Nouveau point';
    $nompoint = '';
    $IDEtat = 0;
    $IDFamille = 0;
    $commentaires = '';
} else {
    $retour_point = $base->query("SELECT *
    FROM points
    WHERE points.IDPoint = '".$IDPoint."'");
    while ($data_point = $retour_point->fetch()){
        $nbpoint = $data_point['nbpoint'];
        $nompoint = $data_point['nompoint'];
        $IDEtat = $data_point['IDEtat'];
        $IDFamille = $data_point['IDFamille'];
        $commentaires = htmlspecialchars($data_point['commentaires'], ENT_QUOTES);
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
border: solid 1px black;'>
    <div style='display: flex;
    flex-wrap: nowrap;
    align-items: center;
    justify-content: flex-end;
    width: 100%;
    height: 45px;
    background-color: rgb(21, 114, 185);';>
        <i class='fa-regular fa-trash-can fa-xl'
        title='Supprimer le point'
        style='color: red; margin-left: 10px;'
        onclick='delete_point(<?php echo $IDPoint; ?>)'></i>
        <div style='display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-size: 25px;
        color: white;'>
        <i class='fa-solid fa-location-dot'
        style='margin: 5px;'></i>
        <?php echo $nbpoint; ?>
        </div>
        <i class='fa-regular fa-rectangle-xmark fa-xl'
        title='Fermer le point'
        style='color: red; margin-right: 10px;'
        onclick='fermer_point()'></i>
    </div>
    <div style='box-shadow: 3px 3px 3px grey;
    width: 293px;
    border: solid 1px black;
    margin-left: 1px;
    margin-top: 5px;
    border-radius: 5px;'>
        <input type='text' id='nompoint' value='<?php echo $nompoint; ?>'
        style='width: calc(100% - 8px);
        margin: 2px;
        font-size: 18px;
        border: none' autofocus>
    </div>
    <div id='details_point' style='
    overflow-y: scroll;
    overflow-x: hidden;'>
        <div style='box-shadow: 3px 3px 3px grey;
        width: 293px;
        border: solid 1px black;
        margin-left: 1px;
        margin-top: 5px;
        border-radius: 5px;'>
            <p style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            padding: 5px;
            font-weight: bold;
            background-color: rgb(21, 114, 185);
            color: white;
            font-size: 22px;'>Etat du point : </p>
            <div style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            margin: 5px;
            font-size: 18px;'>
                <?php
                $retour_etats = $base->query("SELECT *
                FROM etats");
                while ($data_etats = $retour_etats->fetch()){
                    ?>
                    <div>
                        <input type='radio' id='etat<?php echo $data_etats['IDEtat']; ?>' name='etat' value='<?php echo $data_etats['IDEtat']; ?>'
                        <?php
                        if ($data_etats['IDEtat'] == $IDEtat){
                        ?>
                            checked
                        <?php
                        }
                        ?>
                        >
                        <label for='etat<?php echo $data_etats['IDEtat']; ?>'>
                            <i class='fa-solid fa-location-dot' style='color: <?php echo $data_etats['colorEtat']; ?>;'></i>
                            <?php echo $data_etats['nomEtat']; ?>
                            </label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div style='box-shadow: 3px 3px 3px grey;
        width: 293px;
        border: solid 1px black;
        margin-left: 1px;
        margin-top: 5px;
        border-radius: 5px;'>
            <p style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            padding: 5px;
            font-weight: bold;
            background-color: rgb(21, 114, 185);
            color: white;
            font-size: 22px;'>Catégorie :</p>
            <div style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            margin: 5px;
            font-size: 18px;'>
                <div>
                    <input type='radio' id='famille0' name='famille' value='0'>
                    <label for='0'><input type='text' id='labelFamille' value=''></label>
                </div>
                <input type='radio' id='nofamille0' name='famille' value='0' checked style='display: none;'>
                <?php
                $retour_familles = $base->query("SELECT *
                FROM familles");
                while ($data_familles = $retour_familles->fetch()){
                    ?>
                    <div>
                        <input type='radio' id='famille<?php echo $data_familles['IDFamille']; ?>' name='famille' value='<?php echo $data_familles['IDFamille']; ?>'
                        <?php
                        if ($data_familles['IDFamille'] == $IDFamille){
                        ?>
                            checked
                        <?php
                        }
                        ?>
                        >
                        <label for='famille<?php echo $data_familles['IDFamille']; ?>'><?php echo $data_familles['nomFamille']; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div style='box-shadow: 3px 3px 3px grey;
        width: 293px;
        border: solid 1px black;
        margin-left: 1px;
        margin-top: 5px;
        border-radius: 5px;'>
            <p style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            padding: 5px;
            font-weight: bold;
            background-color: rgb(21, 114, 185);
            color: white;
            font-size: 22px;'>Commentaires :</p>
            <div style='display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: nowrap;
            margin: 5px;
            font-size: 18px;'>
                <textarea id="commentaires" style='width: calc(100% - 2px); height: 100px;'><?php echo $commentaires; ?></textarea>
            </div>
        </div>
        <div style='display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;'
        onclick='parcourir_photo_point(<?php echo $IDPoint; ?>)'>
            <i class='fa-solid fa-camera fa-2xl'></i>
            <i class='fa-solid fa-circle picto_fond'></i>
            <i class='fa-regular fa-circle picto_cercle'></i>
            <i class='fa-solid fa-plus fa-2xs picto_plus'></i>
        </div>
        <input type='file' id='fichier_photo_point<?php echo $IDPoint; ?>' accept='image/*'
        style='display: none;'>
        <div style='width: 300px;
        margin-top: 5px;
        margin-bottom: 5px;'>
            <div style='display: flex;
            flex-direction: row;
            flex-wrap: wrap;'>
            <?php
            if (file_exists("../Points/".$IDPoint."/") != false) {
                $scandir = scandir("../Points/".$IDPoint."/");
                foreach($scandir as $fichier){
                    if (substr($fichier, 0, 1) != '.' AND (pathinfo($fichier, PATHINFO_EXTENSION) == "jpg"
                    OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPG"
                    OR pathinfo($fichier, PATHINFO_EXTENSION) == "jpeg"
                    OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPEG"
                    OR pathinfo($fichier, PATHINFO_EXTENSION) == "png"
                    OR pathinfo($fichier, PATHINFO_EXTENSION) == "PNG")){
                        ?>
                        <div style='width: 138px;
                        height: 138px;
                        box-shadow: 3px 3px 3px grey;
                        border: solid 1px black;
                        border-radius: 5px;
                        background-size: cover;
                        background-position: center;
                        background-image: url("../Points/<?php echo $IDPoint."/".$fichier; ?>");
                        background-repeat: no-repeat;
                        margin-left: 4px;
                        margin-right: 4px;
                        margin-bottom: 8px;'
                        onclick='afficher_photo_point("<?php echo $IDPoint."/".$fichier; ?>", "<?php echo $IDPoint; ?>")'>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            </div>
        </div>
    </div>
    <?php
    if ($IDPoint == 0){
        ?>
        <input type='button' value='Créer le point' class='styled' onclick='creer_point()'>
        <?php
    } else {
        ?>
        <input type='button' value='Enregistrer' class='styled' onclick='save_point("<?php echo $IDPoint; ?>")'>
        <?php
    }
    ?>
</div>