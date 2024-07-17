<?php
session_start();
include('../config.php');

$IDChantier = $_POST['IDChantier'];
$retourchantier = $base->query("SELECT chantier.adresse, chantier.telephone, chantier.gsm, chantier.email, chantier.tva, chantier.paye, chantier.commentaire, chantier.administratif
FROM chantier
WHERE chantier.IDChantier = '".$IDChantier."'");
while ($datachantier = $retourchantier->fetch()){
    $adresse = $datachantier['adresse'];
    $telephone = $datachantier['telephone'];
    $gsm = $datachantier['gsm'];
    $email = $datachantier['email'];
    $tva = $datachantier['tva'];
    $paye = $datachantier['paye'];
    $commentaire = htmlspecialchars($datachantier['commentaire'], ENT_QUOTES);
    $administratif = $datachantier['administratif'];
    if ($_SESSION["ModifCategoriehr"] == '1'){
        $modifiable = '';
    } else {
        $modifiable = ' readonly="readonly"';
    }
}
?>
<div class='chantier_details_client'>
    <div class='chantier_details_client_zone'>
        <a href='geo:0,0?q=<?php echo str_replace(' ', '+', $adresse); ?>' style='text-decoration: none;'>
            <i class='fa-sharp fa-solid fa-map-location-dot fa-xl'></i>
        </a>
        <input type='text' id='adresse' value='<?php echo $adresse; ?>'
        title='Adresse postale du client' placeholder='Adresse' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)'
        onKeypress='return valid_mail(event)'>
    </div>
    <div class='chantier_details_client_zone'>
        <a href='tel:<?php echo $telephone; ?>' style='text-decoration: none;'>
            <i class='fa-sharp fa-solid fa-phone fa-xl'></i>
        </a>
        <input type='phone' id='telephone' value='<?php echo $telephone; ?>'
        title='Téléphone fixe du client' placeholder='Téléphone' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)'
        onKeypress='return valid_mail(event)'>
        <a href='tel:<?php echo $gsm; ?>' style='text-decoration: none;'>
            <i class='fa-sharp fa-solid fa-mobile-screen-button fa-xl'></i>
        </a>
        <input type='phone' id='gsm' value='<?php echo $gsm; ?>'
        title='Téléphone portable du client' placeholder='GSM' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)'
        onKeypress='return valid_mail(event)'>
    </div>
    <div class='chantier_details_client_zone'>
        <a href='mailto:<?php echo $email; ?>' style='text-decoration: none;'>
            <i class='fa-sharp fa-solid fa-at fa-xl'></i>
        </a>
        <input type='email' id='email' value='<?php echo $email; ?>'
        title='Adresse email du client' placeholder='Couriel' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)'
        onKeypress='return valid_mail(event)'>
        <?php
        if ($_SESSION["VoirTarifhr"] == '1') {
            ?>
            <i class='fa-brands fa-creative-commons-nc-eu fa-xl'></i>
            <input type='number' id='paye' value='<?php echo $paye; ?>'
            title='Déjà encaissé' placeholder='€' <?php echo $modifiable; ?>
            style='width: 30%;'
            onchange='save_details(<?php echo $IDChantier; ?>)'
            onKeypress='return valid_mail(event)'>
            <?php
        } else {
            ?>
            <input type='hidden' id='paye' value='<?php echo $paye; ?>'>
            <?php
        }
        ?>
        <i class='fa-solid fa-percent fa-xl'></i>
        <select id='tva' title='Taux de TVA du chantier'
        onchange='save_details(<?php echo $IDChantier; ?>)'>
            <?php
            if ($tva == '20'){
            ?>
                <option value='20' selected>20 %</option>
            <?php
            } else {
            ?>
                <option value='20'>20 %</option>
            <?php
            }
            if ($tva == '10'){
            ?>
                <option value='10' selected>10 %</option>
            <?php
            } else {
            ?>
                <option value='10'>10 %</option>
            <?php
            }
            if ($tva == '5.5'){
            ?>
                <option value='5.5' selected>5,5 %</option>
            <?php
            } else {
            ?>
                <option value='5.5'>5,5 %</option>
            <?php
            }
            if ($tva == '0'){
            ?>
                <option value='0' selected>0 %</option>
            <?php
            } else {
            ?>
                <option value='0'>0 %</option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
<div class='chantier_details_commentaire'>
    <textarea id='commentaire' rows='6' title='Commentaires' autocomplete='new-password' placeholder='Commentaires' <?php echo $modifiable; ?>
    onchange='save_details(<?php echo $IDChantier; ?>)'><?php echo $commentaire; ?></textarea>
    <?php
    if ($_SESSION["VoirAdminhr"] == '1') {
        ?>
        <textarea id='commentaire_administratif' rows='6' title='Commentaires administratifs' autocomplete='new-password' placeholder='Commentaires administratifs' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)'><?php echo $administratif; ?></textarea>
        <?php
    } else {
        ?>
        <textarea id='commentaire_administratif' rows='6' title='Commentaires administratifs' autocomplete='new-password' placeholder='Commentaires administratifs' <?php echo $modifiable; ?>
        onchange='save_details(<?php echo $IDChantier; ?>)' style='display: none;'><?php echo $administratif; ?></textarea>
        <?php
    }
    ?>
    <input type='hidden' id='IDChantier' value='<?php echo $IDChantier; ?>'>
</div>