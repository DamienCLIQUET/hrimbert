<?php
session_start();
include('../config.php');

$IDChantier = $_POST['IDChantier'];
$IDDetails = $_POST['IDDetails'];
?>
<div class='produits_produits'>
    <div class='produits_produits_produit_zoneproduit'>
        <div class='produits_produits_produit_zoneproduit_produit'>
            <input type='button' id='' value='En premier -'
            class='produits_produits_produit_zoneproduit_produit_designation'
            style='background: linear-gradient(90deg, green 0%, #a7a7a7 0%);'
            onclick='deplacer_produit(<?php echo $IDDetails; ?>, 0, 0)'>
        </div>
    </div>
<?php
$total = 0;
$retourdetails = $base->query("SELECT details_chantier.IDDetails
, details_chantier.IDPosition
, details_chantier.commentaires
, produits.description
FROM details_chantier
LEFT JOIN produits
ON details_chantier.IDProduit = produits.IDProduit
WHERE details_chantier.IDChantier = '".$IDChantier."' AND details_chantier.IDTitre = '0'
ORDER BY details_chantier.IDPosition");
while ($datadetails = $retourdetails->fetch()){
    $Details = $datadetails['IDDetails'];
    $IDPosition = $datadetails['IDPosition'];
    $commentaires = htmlspecialchars($datadetails['commentaires'], ENT_QUOTES);
    $description = htmlspecialchars($datadetails['description'], ENT_QUOTES);
    ?>
    <div class='produits_produits_produit_zoneproduit'>
        <div class='produits_produits_produit_zoneproduit_produit'>
            <input type='button' id='detailprod<?php echo $IDDetails; ?>'
            value='Après - <?php echo $description; ?>'
            class='produits_produits_produit_zoneproduit_produit_designation'
            style='background: linear-gradient(90deg, green 0%, #a7a7a7 0%);'
            onclick='deplacer_produit(<?php echo $IDDetails; ?>, <?php echo $IDChantier; ?>, 0, <?php echo $IDPosition; ?>)'>
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
                <input type='text' value='<?php echo $titre; ?>'>
            </div>
        </div>
        <div class='produits_produits_produit_zoneproduit'>
            <div class='produits_produits_produit_zoneproduit_produit'>
                <input type='button' id='' value='En premier -'
                class='produits_produits_produit_zoneproduit_produit_designation'
                style='background: linear-gradient(90deg, green 0%, #a7a7a7 0%);'
                onclick='deplacer_produit(<?php echo $IDDetails; ?>, <?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, 0)'>
            </div>
        </div>
        <?php
        $retourdetails = $base->query("SELECT details_chantier.IDDetails
        , details_chantier.IDPosition
        , details_chantier.commentaires
        , produits.description
        FROM details_chantier
        LEFT JOIN produits
        ON details_chantier.IDProduit = produits.IDProduit
        WHERE details_chantier.IDChantier = '".$IDChantier."' AND details_chantier.IDTitre = '".$IDTitre."'
        ORDER BY details_chantier.IDPosition");
        while ($datadetails = $retourdetails->fetch()){
            $Details = $datadetails['IDDetails'];
            $IDPosition = $datadetails['IDPosition'];
            $commentaires = htmlspecialchars($datadetails['commentaires'], ENT_QUOTES);
            $description = htmlspecialchars($datadetails['description'], ENT_QUOTES);
            if ($datadetails['IDDetails'] == $IDDetails){
                ?>
                <div class='produits_produits_produit_zoneproduit'>
                    <div class='produits_produits_produit_zoneproduit_produit'>
                        <input type='button' id='detailprod<?php echo $IDDetails; ?>'
                        value='<?php echo $description; ?>'
                        class='produits_produits_produit_zoneproduit_produit_designation saute'>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class='produits_produits_produit_zoneproduit'>
                    <div class='produits_produits_produit_zoneproduit_produit'>
                        <input type='button' id='detailprod<?php echo $IDDetails; ?>'
                        value='Après - <?php echo $description."//".$Details."//".$IDDetails; ?>'
                        class='produits_produits_produit_zoneproduit_produit_designation'
                        style='background: linear-gradient(90deg, green 0%, #a7a7a7 0%);'
                        onclick='deplacer_produit(<?php echo $IDDetails; ?>, <?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, <?php echo $IDPosition; ?>)'>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
}
?>
</div>