<?php
session_start();
include('../config.php');

?>
<div id='fiche_produit_box'>
<?php
    $IDDetails = $_POST['IDDetails'];
    $retourproduit = $base->query("SELECT details_chantier.quantite, details_chantier.tarif, details_chantier.remise
    , details_chantier.commentaires, details_chantier.avancement, details_chantier.IDChantier, produits.description, produits.unite
    , produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
    , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
    FROM details_chantier
    LEFT JOIN produits
    ON details_chantier.IDProduit = produits.IDProduit
    WHERE details_chantier.IDDetails = '".$IDDetails."'");
    while ($dataproduit = $retourproduit->fetch()){
        $quantite = $dataproduit['quantite'];
        $tarif = $dataproduit['tarif'];
        $remise = $dataproduit['remise'];
        $commentaires = htmlspecialchars($dataproduit['commentaires'], ENT_QUOTES);
        $avancement = $dataproduit['avancement'];
        $IDChantier = $dataproduit['IDChantier'];
        $description = htmlspecialchars($dataproduit['description'], ENT_QUOTES);
        $unite = $dataproduit['unite'];
        for ($i = 1; $i <= 10; $i++) {
            ${"REFART$i"} = $dataproduit['refart'.$i];
        }
        ?>
        <div style='width: 100%;
        display: flex;
        justify-content: space-between;'>
            <i class='fa-regular fa-trash-can fa-2xl'
            style='margin: 5px;
            color: red;
            height: 20px;
            display: flex;
            align-items: center;'
            title='Supprimer le produit'
            onclick='delete_produit(<?php echo $IDDetails; ?>)'></i>
            <i class='fa-regular fa-rectangle-xmark fa-2xl'
            style='margin: 5px;
            height: 20px;
            display: flex;
            align-items: center;'
            onclick="fermer_fiche_produit()"></i>
        </div>
        <div style='display: flex;
        flex-direction: column;
        align-items: center;
        flex-wrap: nowrap;'>
            <?php
            if ($_SESSION["VoirTarifhr"] == '1') {
            ?>
                <div style="margin-bottom: 10px;"
                onmousedown='afficher()'
                onmouseup='masquer()'
                ontouchstart='afficher()'
                ontouchend='masquer()'><?php echo $description; ?></div>
            <?php
            } else {
            ?>
                <div style="margin-bottom: 10px;"><?php echo $description; ?></div>
            <?php
            }
            ?>
            <?php
            echo "<div id='masquer_afficher' style='display: flex;
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;'>";
            for ($i = 1; $i <= 10; $i++) {
                if (strlen(${"REFART$i"}) < 16 AND strlen(${"REFART$i"}) > 10 AND ${"REFART$i"} != '') {
                    echo "<div style='display: flex;
                    flex-direction: column;
                    align-items: center;'>";
                        $retourphoto = $base_electrik->query("SELECT URL
                        FROM media
                        WHERE REFCIALE = '".${"REFART$i"}."' AND TYPM like 'PHOTO%' AND NUM = '1'");
                        while ($dataphoto = $retourphoto->fetch()){
                            echo "<img src='".$dataphoto['URL']."'
                            class='fiche_img'>";
                        }
                        echo "<a href='https://www.melpro.fr/index.php?page=product&refart=".${"REFART$i"}."' target='_blank' style='margin-top: 5px;'>".${"REFART$i"}."</a>";
                    echo "</div>";
                }
            }
            echo "</div>";
            if ($_SESSION["VoirTarifhr"] == '1') {
                ?>
                <div id='afficher_masquer' style="display: none;
                flex-direction: column;
                align-items: center;
                width: 100%;
                background-color: lightslategrey;
                color: white;
                padding: 10px 0;">
                    <?php
                    $total_public = 0;
                    $total_achat = 0;
                    for ($i = 1; $i <= 10; $i++) {
                        if (${"REFART$i"} != ''){
                            echo "<div style='margin-bottom: 10px;'>";
                                $retourtarif = $base->query("SELECT public, achat
                                FROM melpro_tarifs
                                WHERE REFART = '".${"REFART$i"}."'");
                                while ($datatarif = $retourtarif->fetch()){
                                    echo "<p>".${"REFART$i"}." => Tarif : ".number_format(($datatarif['public'] / 100), 2, '.', '')." € / Prix : ".number_format(($datatarif['achat'] / 100), 2, '.', '')." €</p>";
                                    $total_public = $total_public + $datatarif['public'];
                                    $total_achat = $total_achat + $datatarif['achat'];
                                }
                            echo "</div>";
                        }
                    }
                    echo "<p>TOTAL => Tarif : ".number_format(($total_public / 100), 2, '.', '')." € / Prix : ".number_format(($total_achat / 100), 2, '.', '')." €</p>";
                    ?>
                </div>
            <?php
            }
            ?>
            <div style='display: flex;'>
                <input type='text' id='quantiteproduit<?php echo $IDDetails; ?>' value='<?php echo number_format($quantite, 2, '.', ''); ?>'
                class='fiche_produit_box_input'
                onKeypress='return valid_number(event)'
                onchange='save_fiche_produit(<?php echo $IDDetails; ?>)'
                onfocus='this.select();'
                onclick='this.select();'>
                <?php echo $unite; ?>
            </div>
            <?php
            if ($_SESSION["VoirTarifhr"] == '1') {
            ?>
                <div style='display: flex;'>
                    <input type='text' id='tarifproduit<?php echo $IDDetails; ?>' value='<?php echo number_format($tarif, 2, '.', ''); ?>'
                    class='fiche_produit_box_input'
                    onKeypress='return valid_number(event)'
                    onchange='save_fiche_produit(<?php echo $IDDetails; ?>)'
                    onfocus='this.select();'
                    onclick='this.select();'> € / <?php echo $unite; ?>
                </div>
                <div style='display: flex;'>
                    <input type='text' id='remiseproduit<?php echo $IDDetails; ?>' value='<?php echo number_format($remise, 2, '.', ''); ?>'
                    class='fiche_produit_box_input'
                    onKeypress='return valid_number(event)'
                    onchange='save_fiche_produit(<?php echo $IDDetails; ?>)'
                    onfocus='this.select();'
                    onclick='this.select();'> % de remise (<p id='prixremise'><?php echo number_format((100 - $remise) / 100 * $tarif, 2, '.', ''); ?></p> €)
                </div>
            <?php
            }
            ?>
            <div>
                <input type='text' value='<?php echo $commentaires; ?>' id='com<?php echo $IDDetails; ?>'
                style='width: 90svw;'
                title='Commentaires'
                placeholder='Commentaires'
                onchange='save_commentaire(<?php echo $IDDetails; ?>, this.value)'>
            </div>
            <b>Avancement : </b>
            <meter id='avancement_visuel' min='0' max='100' low='49' high='76' optimum='90' value='<?php echo $avancement; ?>'
            style='width: 100%;
            max-width: 700px;'></meter>
            <div>
                <input type='button' value='-10%'
                style='text-align: right;
                padding: 10px;'
                class='styled'
                onclick='maj_avancement(<?php echo $IDDetails; ?>, 1)'>
                <input type='text' id='avancement' min=0 max=100 step='10' value='<?php echo $avancement; ?>'
                style='border: none;
                background-color: transparent;
                text-align: right;
                width: 60px;'
                onKeypress='return valid_number(event)'
                onchange='avancement(<?php echo $IDDetails; ?>, this.value)'
                onfocus='this.select();'
                onclick='this.select();'> %
                <input type='button' value='+10%'
                style='text-align: right;
                padding: 10px;'
                class='styled'
                onclick='maj_avancement(<?php echo $IDDetails; ?>, 2)'>
                <input type='button' value='100%'
                style='text-align: right;
                padding: 10px;'
                class='styled'
                onclick='maj_avancement(<?php echo $IDDetails; ?>, 3)'>
            </div>
        </div>
        <?php
    }
?>
</div>