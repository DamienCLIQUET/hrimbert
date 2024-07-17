<?php
session_start();
include('../config.php');

$IDChantier = $_POST['IDChantier'];
?>
<div class='produits_ajout'>
    <div class='produits_ajout_titre'
    title='Ajouter une catégorie'
    onclick='new_titre(<?php echo $IDChantier; ?>)'>
        <i class='fa-solid fa-box-open fa-2xl'></i>
        <i class='fa-solid fa-circle picto_fond'></i>
        <i class='fa-regular fa-circle picto_cercle'></i>
        <i class='fa-solid fa-plus fa-2xs picto_plus_produit'></i>
    </div>
    <div class='produits_produits_produit_zonetitre_pictos'>
        <i class='fa-solid fa-plug-circle-plus fa-xl' title='Ajouter un produit'
        onclick='new_produit(<?php echo $IDChantier; ?>, 0, 0, 0, "")'></i>
    </div>
</div>
<div class='produits_produits'>
<?php
$total = 0;
$retourdetails = $base->query("SELECT details_chantier.IDDetails
, details_chantier.IDProduit
, details_chantier.quantite
, details_chantier.tarif
, details_chantier.remise
, details_chantier.avancement
, details_chantier.commentaires
, produits.description
, produits.unite
FROM details_chantier
LEFT JOIN produits
ON details_chantier.IDProduit = produits.IDProduit
WHERE details_chantier.IDChantier = '".$IDChantier."' AND details_chantier.IDTitre = '0'
ORDER BY details_chantier.IDPosition");
while ($datadetails = $retourdetails->fetch()){
    $IDDetails = $datadetails['IDDetails'];
    $IDProduit = $datadetails['IDProduit'];
    $quantite = $datadetails['quantite'];
    $tarif = $datadetails['tarif'];
    $remise = $datadetails['remise'];
    $avancement = $datadetails['avancement'];
    $commentaires = htmlspecialchars($datadetails['commentaires'], ENT_QUOTES);
    $description = htmlspecialchars($datadetails['description'], ENT_QUOTES);
    $unite = $datadetails['unite'];
    $total += floatval($tarif) * floatval($quantite) * (100 - floatval($remise)) / 100;
    if ($remise != 0){
        $soustotal = (floatval($tarif) * floatval($quantite) * (100 - floatval($remise)) / 100)." €";
    } else {
        $soustotal = '';
    }
    ?>
    <div class='produits_produits_produit_zoneproduit'>
        <div class='produits_produits_produit_zoneproduit_produit'>
            <input type='button' id='detailprod<?php echo $IDDetails; ?>' value='<?php echo $description; ?>'
            class='produits_produits_produit_zoneproduit_produit_designation'
            style='background: linear-gradient(90deg, green <?php echo $avancement; ?>%, #a7a7a7 0%);'
            onclick='afficher_produit("<?php echo $IDDetails; ?>")'>
            <?php
            if ($_SESSION["VoirTarifhr"] == '1') {
            ?>
                <i class='fa-solid fa-up-down-left-right fa-xl' style='margin-left: 15px; margin-right: 5px;' title='Déplacer le produit'
                onclick='deplacer_produits(<?php echo $IDChantier; ?>, <?php echo $IDDetails; ?>)'></i>
            <?php
            }
            ?>
            <input type='text' id='quantiteprod<?php echo $IDDetails; ?>' value='<?php echo number_format($quantite, 2, '.', ''); ?>'
            class='produits_produits_produit_zoneproduit_produit_quantite'
            onKeypress='return valid_number(event)'
            onchange='save_produit(<?php echo $IDDetails; ?>)'
            onfocus='this.select();'
            onclick='this.select();'>
            <p class='produits_produits_produit_zoneproduit_produit_unite'><?php echo $unite; ?></p>
            <?php
            if ($_SESSION["VoirTarifhr"] == '1') {
            ?>
                <div class='produits_produits_produit_zoneproduit_produit_remise'>
                    <input type='text' id='remiseprod<?php echo $IDDetails; ?>' value='<?php echo number_format($remise, 2, '.', ''); ?>'
                    onKeypress='return valid_number(event)'
                    onchange='save_produit(<?php echo $IDDetails; ?>)'
                    onfocus='this.select();'
                    onclick='this.select();'> %
                </div>
                <div class='produits_produits_produit_zoneproduit_produit_tarif'>
                    <input type='text' id='tarifprod<?php echo $IDDetails; ?>' value='<?php echo number_format($tarif, 2, '.', ''); ?>'
                    onKeypress='return valid_number(event)'
                    onchange='save_produit(<?php echo $IDDetails; ?>)'
                    onfocus='this.select();'
                    onclick='this.select();'> €
                </div>
                <i class='fa-regular fa-trash-can fa-xl' style='margin-left: 15px; margin-right: 5px; color: red;'
                title='Supprimer le produit'
                onclick='delete_produit(<?php echo $IDDetails; ?>)'></i>
            <?php
            }
            ?>
        </div>
        <div class='produits_produits_produit_zoneproduit_commentaires'>
            <input type='text' id='commentaireprod<?php echo $IDDetails; ?>' value='<?php echo $commentaires; ?>'
            onchange='save_commentaire(<?php echo $IDDetails; ?>, this.value)'>
            <p><?php echo $soustotal; ?></p>
        </div>
    </div>
    <?php
}
$retourtitres = $base->query("SELECT IDTitre, titre
FROM titres_chantier
WHERE IDChantier = '".$IDChantier."'
ORDER BY IDPosition");
while ($datatitres = $retourtitres->fetch()){
    $IDTitre = $datatitres['IDTitre'];
    $titre = $datatitres['titre'];
    ?>
    <div class='produits_produits_produit'>
        <div class='produits_produits_produit_zonetitre'>
            <div class='produits_produits_produit_zonetitre_titre'>
                <input type='text' value='<?php echo $titre; ?>'
                onchange='save_titre(<?php echo $IDTitre; ?>, this.value)'>
            </div>
            <div class='produits_produits_produit_zonetitre_pictos'>
                <i class='fa-regular fa-copy fa-xl'
                title='Cloner la zone'
                style='width: 1em;
                height: 1em;
                display: flex;
                margin: 5px 15px;
                color: white;
                align-items: center;'
                onclick='copier_titre(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>)'></i>
                <i class='fa-solid fa-plug-circle-plus fa-xl'
                title='Ajouter un produit'
                style='width: 1em;
                height: 1em;
                display: flex;
                margin: 5px 15px;
                color: white;
                align-items: center;'
                onclick='new_produit(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, 0, 0, "")'></i>
                <i class='fa-regular fa-trash-can fa-xl'
                title='Supprimer la catégorie'
                style='width: 1em;
                height: 1em;
                display: flex;
                margin: 5px 25px;
                color: red;
                align-items: center;'
                onclick='delete_titre(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>)'></i>
            </div>
        </div>
        <?php
        $retourdetails = $base->query("SELECT details_chantier.IDDetails
        , details_chantier.IDProduit
        , details_chantier.quantite
        , details_chantier.tarif
        , details_chantier.remise
        , details_chantier.avancement
        , details_chantier.commentaires
        , produits.description
        , produits.unite
        FROM details_chantier
        LEFT JOIN produits
        ON details_chantier.IDProduit = produits.IDProduit
        WHERE details_chantier.IDChantier = '".$IDChantier."' AND details_chantier.IDTitre = '".$IDTitre."'
        ORDER BY details_chantier.IDPosition");
        while ($datadetails = $retourdetails->fetch()){
            $IDDetails = $datadetails['IDDetails'];
            $IDProduit = $datadetails['IDProduit'];
            $quantite = $datadetails['quantite'];
            $tarif = $datadetails['tarif'];
            $remise = $datadetails['remise'];
            $avancement = $datadetails['avancement'];
            $commentaires = htmlspecialchars($datadetails['commentaires'], ENT_QUOTES);
            $description = htmlspecialchars($datadetails['description'], ENT_QUOTES);
            $unite = $datadetails['unite'];
            $total += floatval($tarif) * floatval($quantite) * (100 - floatval($remise)) / 100;
            if ($remise != 0){
                $soustotal = (floatval($tarif) * floatval($quantite) * (100 - floatval($remise)) / 100)." €";
            } else {
                $soustotal = '';
            }
            ?>
            <div class='produits_produits_produit_zoneproduit'>
                <div class='produits_produits_produit_zoneproduit_produit'>
                    <input type='button' id='detailprod<?php echo $IDDetails; ?>' value='<?php echo $description; ?>'
                    class='produits_produits_produit_zoneproduit_produit_designation'
                    style='background: linear-gradient(90deg, green <?php echo $avancement; ?>%, #a7a7a7 0%);'
                    onclick='afficher_produit("<?php echo $IDDetails; ?>")'>
                    <?php
                    if ($_SESSION["VoirTarifhr"] == '1') {
                    ?>
                        <i class='fa-solid fa-up-down-left-right fa-xl' style='margin-left: 15px; margin-right: 5px;' title='Déplacer le produit'
                        onclick='deplacer_produits(<?php echo $IDChantier; ?>, <?php echo $IDDetails; ?>)'></i>
                    <?php
                    }
                    ?>
                    <input type='text' id='quantiteprod<?php echo $IDDetails; ?>' value='<?php echo number_format($quantite, 2, '.', ''); ?>'
                    class='produits_produits_produit_zoneproduit_produit_quantite'
                    onKeypress='return valid_number(event)'
                    onchange='save_produit(<?php echo $IDDetails; ?>)'
                    onfocus='this.select();'
                    onclick='this.select();'>
                    <p class='produits_produits_produit_zoneproduit_produit_unite'><?php echo $unite; ?></p>
                    <?php
                    if ($_SESSION["VoirTarifhr"] == '1') {
                    ?>
                        <div class='produits_produits_produit_zoneproduit_produit_remise'>
                            <input type='text' id='remiseprod<?php echo $IDDetails; ?>' value='<?php echo number_format($remise, 2, '.', ''); ?>'
                            onKeypress='return valid_number(event)'
                            onchange='save_produit(<?php echo $IDDetails; ?>)'
                            onfocus='this.select();'
                            onclick='this.select();'> %
                        </div>
                        <div class='produits_produits_produit_zoneproduit_produit_tarif'>
                            <input type='text' id='tarifprod<?php echo $IDDetails; ?>' value='<?php echo number_format($tarif, 2, '.', ''); ?>'
                            onKeypress='return valid_number(event)'
                            onchange='save_produit(<?php echo $IDDetails; ?>)'
                            onfocus='this.select();'
                            onclick='this.select();'> €
                        </div>
                        <i class='fa-regular fa-trash-can fa-xl' style='margin-left: 15px; margin-right: 5px; color: red;' title='Supprimer le produit'
                        onclick='delete_produit(<?php echo $IDDetails; ?>)'></i>
                    <?php
                    }
                    ?>
                </div>
                <div class='produits_produits_produit_zoneproduit_commentaires'>
                    <input type='text' id='commentaireprod<?php echo $IDDetails; ?>' value='<?php echo $commentaires; ?>'
                    onchange='save_commentaire(<?php echo $IDDetails; ?>, this.value)'>
                    <p><?php echo $soustotal; ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>
<?php
if ($_SESSION["VoirTarifhr"] == '1') {
?>
    <div class='produits_total'>
        <input type='text' id='montanttotal' value='Total : <?php echo number_format($total, 2, '.', ''); ?> €'
        style='' readonly='readonly'>
    </div>
<?php
}
?>