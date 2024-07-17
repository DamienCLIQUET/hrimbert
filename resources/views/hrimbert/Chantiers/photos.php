<?php
session_start();
include('../config.php');

$IDChantier = $_POST['IDChantier'];
?>
<div class='photos_ajout'>
    <div style='display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;'
    title='Ajouter une photo'
    onclick='parcourir_photo(<?php echo $IDChantier; ?>)'>
        <i class='fa-solid fa-image fa-2xl'></i>
        <i class='fa-solid fa-circle picto_fond'></i>
        <i class='fa-regular fa-circle picto_cercle'></i>
        <i class='fa-solid fa-plus fa-2xs picto_plus'></i>
    </div>
    <input type='file' id='fichier_photo<?php echo $IDChantier; ?>' accept='image/*' multiple
    style='display: none;'>
</div>
<div class='photos_photos'>
<?php
    if (file_exists("../Photos/".$IDChantier."/") != false) {
        $scandir = scandir("../Photos/".$IDChantier."/");
        foreach($scandir as $fichier){
            if (substr($fichier, 0, 1) != '.' AND pathinfo($fichier, PATHINFO_EXTENSION) != "pdf" AND pathinfo($fichier, PATHINFO_EXTENSION) != "PDF"){
                ?>
                <div id='Phot<?php echo $IDChantier."/".$fichier; ?>' class='photos_photos_photo'>
                    <img src='<?php echo "../Photos/".$IDChantier."/".$fichier; ?>'
                    onclick='afficher_photo("<?php echo $IDChantier."/".$fichier; ?>")'>
                    <i class='fa-solid fa-trash-can fa-xl' title='Supprimer la photo'
                    onclick='supprimer_photo("<?php echo $IDChantier."/".$fichier; ?>")'></i>
                </div>
                <?php
            }
        }
    }
?>
</div>