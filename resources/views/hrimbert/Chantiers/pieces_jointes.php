<?php
session_start();
include('../config.php');

if ($_SESSION["VoirTarifhr"] == '1') {
$IDChantier = $_POST['IDChantier'];
?>
<div class='pieces_jointes_ajout'>
    <div style='display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;'
    title='Ajouter un fichier'
    onclick='parcourir_PJ(<?php echo $IDChantier; ?>)'>
        <i class='fa-solid fa-file fa-2xl'></i>
        <i class='fa-solid fa-circle picto_fond'></i>
        <i class='fa-regular fa-circle picto_cercle'></i>
        <i class='fa-solid fa-plus fa-2xs picto_plus'></i>
    </div>
    <input type='file' id='fichier_PJ<?php echo $IDChantier; ?>' accept='application/pdf' multiple
    style='display: none;'>
</div>
<div class='pieces_jointes_pieces_jointes'>
<?php
    if (file_exists("../Pj/".$IDChantier."/") != false) {
        $scandir = scandir("../Pj/".$IDChantier."/");
        foreach($scandir as $fichier){
            if (substr($fichier, 0, 1) != '.' AND (pathinfo($fichier, PATHINFO_EXTENSION) == "pdf" OR pathinfo($fichier, PATHINFO_EXTENSION) == "PDF")){
                ?>
                <div class='pieces_jointes_pieces_jointes_pj'>
                    <a class='pieces_jointes_pieces_jointes_pj_lien'
                    href='<?php echo "../Pj/".$IDChantier."/".$fichier; ?>'
                    target='_blank'><?php echo $fichier; ?></a>
                    <i class='fa-solid fa-trash-can fa-xl' title='Supprimer la pièce jointe'
                    onclick='supprimer_PJ("<?php echo $IDChantier."/".$fichier; ?>")'></i>
                </div>
                <?php
            }
        }
    }
?>
</div>
<?php
}
?>