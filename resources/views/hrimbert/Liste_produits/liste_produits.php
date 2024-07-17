<?php
include('../config.php');

$IDChantier = $_POST['IDChantier'];
$IDTitre = $_POST['IDTitre'];
$niveau = $_POST['niveau'];
$filtre = $_POST['filtre'];
if ($niveau > 0){
    $retourprecedent = $base->query("SELECT arborescence.dad
    FROM arborescence
    WHERE arborescence.son = '".$niveau."'");
    while ($dataprecedent = $retourprecedent->fetch()){
        $precedent = $dataprecedent['dad'];
    }
} else {
    $precedent = '0';
}
?>
<div class='liste_produits_box'>
    <div class='liste_produits_box_titres'>
        <div class='liste_produits_box_titres_precedent' onclick='new_produit(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, <?php echo $precedent; ?>, "")'>
            <i class='fa-solid fa-backward fa-2xl'></i>
        </div>
        <div class='liste_produits_box_titres_recherche'>
            <i class='fa-solid fa-magnifying-glass fa-2xl'></i>
            <input type='text' id='recherche'
            title='recherche'
            placeholder='recherche'
            onkeyup='filtrer(this.value)'>
        </div>
        <div class='liste_produits_box_titres_fermer' onclick='fermer_liste_produits()'>
            <i class='fa-regular fa-rectangle-xmark fa-2xl'></i>
        </div>
    </div>
    <div class='liste_produits_box_corps'>
        <?php
        $retourlisteproduits = $base->query("SELECT arborescence.type, arborescence.son, produits.IDProduit, produits.unite, produits.description, produits.tarif
        FROM arborescence
        INNER JOIN produits
        ON arborescence.son = produits.IDProduit
        WHERE arborescence.dad = '".$niveau."'
        ORDER BY arborescence.type DESC, produits.description");
        while ($datalisteproduits = $retourlisteproduits->fetch()){
            $type = $datalisteproduits['type'];
            $son = $datalisteproduits['son'];
            $IDProduit = $datalisteproduits['IDProduit'];
            $description = htmlspecialchars($datalisteproduits['description'], ENT_QUOTES);
            $unite = $datalisteproduits['unite'];
            $tarif = $datalisteproduits['tarif'];
            if ($type == 'N'){
                ?>
                <div class='liste_produits_box_corps_N quelproduit <?php echo $description; ?>'
                onclick='new_produit(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, <?php echo $son; ?>, "")'>
                    <div class='liste_produits_box_corps_N_nom'>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>
                <?php
            } elseif ($type == 'A'){
                ?>
                <div class='liste_produits_box_corps_A quelproduit <?php echo $description; ?>' id='liste_produits_<?php echo $IDProduit; ?>'>
                    <div class='liste_produits_box_corps_A_nom'>
                        <p class='liste_produits_box_corps_A_nom_description'><?php echo $description; ?></p>
                        <input type='text' id='quantite<?php echo $IDProduit; ?>' title='Quantité' placeholder='Qté'
                        class='liste_produits_box_corps_A_nom_quantite'
                        onfocus='this.select();'
                        onclick='this.select();'>
                        <p class='liste_produits_box_corps_A_nom_unite'><?php echo $unite; ?></p>
                        <input type='number' id='tarif<?php echo $IDProduit; ?>' title='Prix de vente' placeholder='€' value='<?php echo $tarif; ?>'
                        class='liste_produits_box_corps_A_nom_tarif'
                        onfocus='this.select();'
                        onclick='this.select();'>
                        <i class='fa-solid fa-right-to-bracket fa-xl'
                        id='add_produit<?php echo $IDProduit; ?>'
                        title='Ajouter <?php echo $description; ?>'
                        onclick='add_produit(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, <?php echo $IDProduit; ?>, "")'></i>
                    </div>
                </div>
                <?php
            /*} elseif ($type == 'G'){*/
            }
        }
        ?>
        <div class='liste_produits_box_corps_N' id='liste_produits_new_arborescence'>
            <div class='liste_produits_box_corps_N_newnom'>
                <input type='text' id='arborescence' title='Titre' placeholder='Titre' style='width: 100% !important;'>
                <i class='fa-solid fa-right-to-bracket fa-xl'
                title='Créer cette nouvelle catégorie'
                onclick='add_new_arborescence(<?php echo $IDChantier; ?>, <?php echo $IDTitre; ?>, <?php echo $niveau; ?>, <?php echo $filtre; ?>)'></i>
            </div>
        </div>
        <div class='liste_produits_box_corps_A' id='liste_produits_new_produit'>
            <div class='liste_produits_box_corps_A_newnom'>
                <input type='text' id='quantite' title='Quantité' placeholder='Qté'
                class='liste_produits_box_corps_A_newnom_quantite'
                onfocus='this.select();'
                onclick='this.select();'>
                <input type='text' id='unite' title='Unité' placeholder='Unité'
                class='liste_produits_box_corps_A_newnom_unite'>
                <p> de </p>
                <input type='text' id='designation' title='Désignation' placeholder='Désignation'
                class='liste_produits_box_corps_A_newnom_designation'>
                <input type='text' id='tarif' title='Prix de vente' placeholder='€'
                class='liste_produits_box_corps_A_newnom_unite'
                onfocus='this.select();'
                onclick='this.select();'>
                <i class='fa-solid fa-right-to-bracket fa-xl'
                title='Créer ce nouveau produit'
                onclick='add_new_produit("<?php echo $IDChantier; ?>", "<?php echo $IDTitre; ?>", "<?php echo $niveau; ?>", "<?php echo $filtre; ?>")'></i>
            </div>
        </div>
    </div>
</div>