<?php
include('../config.php');

echo "<div style='width: calc(100% - 40px); overflow-y: scroll; height: calc(100svh - 49px);'>";
    echo "<div style='border-top: solid 0px grey; margin-top: 2px; display: flex; align-items: center;'>";
    echo "<img src='Images/Cible.png' id='0' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
    ondrop='Coller(event)'
    ondragover='allowDrop(event)'>";
    echo "<a style='border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; padding: 5px; border-radius: 5px;'>Mes produits</a>";
    /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
    onclick='ajou_cat(0)'>";
    echo "<a style='color: green; font-weight: bold;'> Ajouter une catégorie</a>";*/
    echo "</div>";
    $retourtype = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
    , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
    , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
    FROM arborescence
    LEFT JOIN produits
    ON arborescence.son = produits.IDProduit
    LEFT JOIN details_chantier
    ON details_chantier.IDProduit = produits.IDProduit
    WHERE dad = '0'
    GROUP BY arborescence.son
    ORDER BY arborescence.type, produits.description");
    while ($datatype = $retourtype->fetch()){
        if ($datatype['type'] == 'A'){
            $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
            echo "<div class='N0' style='margin-left: 5vw; border-top: solid 0px grey; margin-top: 2px; display: flex; align-items: center;'>";
            echo "<img src='Images/Deplacer.png' id='".$datatype['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
            ondragstart='Copier(event)'
            ondblclick='afficher_cat(".$datatype['son'].")'>";
            /*echo "<img src='Images/Cible.png' id='".$datatype['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
            ondrop='Coller(event)'
            ondragover='allowDrop(event)'>";*/
        /*} elseif ($datatype['type'] == 'G'){
            $color = " color: #7a3aa0; background-color: #7a3aa070;";
            echo "<div class='N0' style='margin-left: 5vw; border-top: solid 0px grey; margin-top: 2px; display: flex; align-items: center;'>";
            echo "<img src='Images/Deplacer.png' id='".$datatype['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
            ondragstart='Copier(event)'
            ondblclick='afficher_cat(".$datatype['son'].")'>";
            //echo "<img src='Images/Cible.png' id='".$datatype['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
            ondrop='Coller(event)'
            ondragover='allowDrop(event)'>";*/
        } else {
            $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
            echo "<div class='N0' style='margin-left: 5vw; border-top: solid 0px grey; margin-top: 2px; display: flex; align-items: center;'>";
            echo "<img src='Images/Deplacer.png' id='".$datatype['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
            ondragstart='Copier(event)'
            ondblclick='afficher_cat(".$datatype['son'].")'>";
            echo "<img src='Images/Cible.png' id='".$datatype['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
            ondrop='Coller(event)'
            ondragover='allowDrop(event)'>";
        }
        if ($datatype['utilis'] > 0) {
            $supprimable = false;
            $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
            echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype['utilis']." fois'
            onchange='save_description_produit(".$datatype['son'].", this.value)'>";
        } else {
            $supprimable = true;
            echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype['description'], ENT_QUOTES)."'
            onchange='save_description_produit(".$datatype['son'].", this.value)'>";
        }
        if ($datatype['type'] == 'A'){
            echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype['unite'], ENT_QUOTES)."'
            onchange='save_unite_produit(".$datatype['son'].", this.value)'>";
            echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype['tarif'], ENT_QUOTES)."'
            onchange='save_tarif_base_produit(".$datatype['son'].", this.value)'> €";
            echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
            echo "<summary>LIENS</summary>";
                echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart1'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 1)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart2'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 2)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart3'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 3)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart4'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 4)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart5'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 5)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart6'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 6)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart7'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 7)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart8'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 8)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart9'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 9)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart10'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 10)'>";
            echo "</details>";
        /*} elseif ($datatype['type'] == 'G'){
            echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype['unite'], ENT_QUOTES)."'
            onchange='save_unite_produit(".$datatype['son'].", this.value)'>";
            echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype['tarif'], ENT_QUOTES)."'
            onchange='save_tarif_base_produit(".$datatype['son'].", this.value)'> €";
            echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
            echo "<summary>LIENS</summary>";
                echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart1'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 1)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart2'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 2)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart3'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 3)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart4'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 4)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart5'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 5)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart6'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 6)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart7'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 7)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart8'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 8)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart9'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 9)'>";
                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype['refart10'], ENT_QUOTES)."'
                onchange='save_lien(".$datatype['son'].", this.value, 10)'>";
            echo "</details>";
            echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
            onclick='ajou_prod(".$datatype['son'].")'>";
            echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
        } else {
            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
            onclick='ajou_cat(".$datatype['son'].")'>";
            echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
            onclick='ajou_groupe(".$datatype['son'].")'>";
            echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
            onclick='ajou_prod(".$datatype['son'].")'>";
            echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
            $supprimable = true;
            $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype['son']."'");
            while ($dataexist = $retourexist->fetch()){
                $supprimable = false;
            }
        }
        if($supprimable === true) {
            echo "<img src='Images/Plus_poubelle.png' id='".$datatype['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
            onclick='Supprimer_base(".$datatype['son'].")'>";
        } else {
            echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
        }
        echo "</div>";
        $retourtype2 = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
        , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
        , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
        FROM arborescence
        LEFT JOIN produits
        ON arborescence.son = produits.IDProduit
        LEFT JOIN details_chantier
        ON details_chantier.IDProduit = produits.IDProduit
        WHERE dad = '".$datatype['son']."'
        GROUP BY arborescence.son
        ORDER BY arborescence.type, produits.description");
        while ($datatype2 = $retourtype2->fetch()){
            if ($datatype2['type'] == 'A'){
                $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                echo "<div class='N0 ".$datatype['son']."' style='margin-left: 10vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                echo "<img src='Images/Deplacer.png' id='".$datatype2['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                ondragstart='Copier(event)'
                ondblclick='afficher_cat(".$datatype2['son'].")'>";
                /*echo "<img src='Images/Cible.png' id='".$datatype2['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                ondrop='Coller(event)'
                ondragover='allowDrop(event)'>";*/
            /*} elseif ($datatype2['type'] == 'G'){
                $color = " color: #7a3aa0; background-color: #7a3aa070;";
                echo "<div class='N0 ".$datatype['son']."' style='margin-left: 10vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                echo "<img src='Images/Deplacer.png' id='".$datatype2['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                ondragstart='Copier(event)'
                ondblclick='afficher_cat(".$datatype2['son'].")'>";
                //echo "<img src='Images/Cible.png' id='".$datatype2['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                ondrop='Coller(event)'
                ondragover='allowDrop(event)'>";*/
            } else {
                $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
                echo "<div class='N0 ".$datatype['son']."' style='margin-left: 10vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                echo "<img src='Images/Deplacer.png' id='".$datatype2['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                ondragstart='Copier(event)'
                ondblclick='afficher_cat(".$datatype2['son'].")'>";
                echo "<img src='Images/Cible.png' id='".$datatype2['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                ondrop='Coller(event)'
                ondragover='allowDrop(event)'>";
            }
            if ($datatype2['utilis'] > 0) {
                $supprimable = false;
                $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype2['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype2['utilis']." fois'
                onchange='save_description_produit(".$datatype2['son'].", this.value)'>";
            } else {
                $supprimable = true;
                echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype2['description'], ENT_QUOTES)."'
                onchange='save_description_produit(".$datatype2['son'].", this.value)'>";
            }
            if ($datatype2['type'] == 'A'){
                echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype2['unite'], ENT_QUOTES)."'
                onchange='save_unite_produit(".$datatype2['son'].", this.value)'>";
                echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype2['tarif'], ENT_QUOTES)."'
                onchange='save_tarif_base_produit(".$datatype2['son'].", this.value)'> €";
                echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                echo "<summary>LIENS</summary>";
                    echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart1'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 1)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart2'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 2)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart3'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 3)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart4'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 4)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart5'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 5)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart6'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 6)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart7'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 7)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart8'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 8)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart9'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 9)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart10'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 10)'>";
                echo "</details>";
            /*} elseif ($datatype2['type'] == 'G'){
                echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype2['unite'], ENT_QUOTES)."'
                onchange='save_unite_produit(".$datatype2['son'].", this.value)'>";
                echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype2['tarif'], ENT_QUOTES)."'
                onchange='save_tarif_base_produit(".$datatype2['son'].", this.value)'> €";

                echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                echo "<summary>LIENS</summary>";
                    echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart1'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 1)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart2'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 2)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart3'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 3)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart4'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 4)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart5'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 5)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart6'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 6)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart7'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 7)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart8'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 8)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart9'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 9)'>";
                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype2['refart10'], ENT_QUOTES)."'
                    onchange='save_lien(".$datatype2['son'].", this.value, 10)'>";
                echo "</details>";
                echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                onclick='ajou_prod(".$datatype2['son'].")'>";
                echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
            } else {
                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                onclick='ajou_cat(".$datatype2['son'].")'>";
                echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                onclick='ajou_groupe(".$datatype2['son'].")'>";
                echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                onclick='ajou_prod(".$datatype2['son'].")'>";
                echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                $supprimable = true;
                $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype2['son']."'");
                while ($dataexist = $retourexist->fetch()){
                    $supprimable = false;
                }
            }
            if($supprimable === true) {
                echo "<img src='Images/Plus_poubelle.png' id='".$datatype2['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
                onclick='Supprimer_base(".$datatype2['son'].")'>";
            } else {
                echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
            }
            echo "</div>";
            $retourtype3 = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
            , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
            , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
            FROM arborescence
            LEFT JOIN produits
            ON arborescence.son = produits.IDProduit
            LEFT JOIN details_chantier
            ON details_chantier.IDProduit = produits.IDProduit
            WHERE dad = '".$datatype2['son']."'
            GROUP BY arborescence.son
            ORDER BY arborescence.type, produits.description");
            while ($datatype3 = $retourtype3->fetch()){
                if ($datatype3['type'] == 'A'){
                    $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                    echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']."' style='margin-left: 15vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                    echo "<img src='Images/Deplacer.png' id='".$datatype3['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                    ondragstart='Copier(event)'
                    ondblclick='afficher_cat(".$datatype3['son'].")'>";
                    /*echo "<img src='Images/Cible.png' id='".$datatype3['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                    ondrop='Coller(event)'
                    ondragover='allowDrop(event)'>";*/
                /*} elseif ($datatype3['type'] == 'G'){
                    $color = " color: #7a3aa0; background-color: #7a3aa070;";
                    echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']."' style='margin-left: 15vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                    echo "<img src='Images/Deplacer.png' id='".$datatype3['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                    ondragstart='Copier(event)'
                    ondblclick='afficher_cat(".$datatype3['son'].")'>";
                    //echo "<img src='Images/Cible.png' id='".$datatype3['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                    ondrop='Coller(event)'
                    ondragover='allowDrop(event)'>";*/
                } else {
                    $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
                    echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']."' style='margin-left: 15vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                    echo "<img src='Images/Deplacer.png' id='".$datatype3['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                    ondragstart='Copier(event)'
                    ondblclick='afficher_cat(".$datatype3['son'].")'>";
                    echo "<img src='Images/Cible.png' id='".$datatype3['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                    ondrop='Coller(event)'
                    ondragover='allowDrop(event)'>";
                }        
                if ($datatype3['utilis'] > 0) {
                    $supprimable = false;
                    $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                    echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype3['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype3['utilis']." fois'
                    onchange='save_description_produit(".$datatype3['son'].", this.value)'>";
                } else {
                    $supprimable = true;
                    echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype3['description'], ENT_QUOTES)."'
                    onchange='save_description_produit(".$datatype3['son'].", this.value)'>";
                }
                if ($datatype3['type'] == 'A'){
                    echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype3['unite'], ENT_QUOTES)."'
                    onchange='save_unite_produit(".$datatype3['son'].", this.value)'>";
                    echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype3['tarif'], ENT_QUOTES)."'
                    onchange='save_tarif_base_produit(".$datatype3['son'].", this.value)'> €";
                    echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                    echo "<summary>LIENS</summary>";
                        echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart1'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 1)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart2'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 2)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart3'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 3)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart4'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 4)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart5'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 5)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart6'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 6)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart7'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 7)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart8'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 8)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart9'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 9)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart10'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 10)'>";
                    echo "</details>";
                    //echo "<input type='checkbox' style='margin-left: 10px'>";
                /*} elseif ($datatype3['type'] == 'G'){
                    echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype3['unite'], ENT_QUOTES)."'
                    onchange='save_unite_produit(".$datatype3['son'].", this.value)'>";
                    echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype3['tarif'], ENT_QUOTES)."'
                    onchange='save_tarif_base_produit(".$datatype3['son'].", this.value)'> €";
                    echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                    echo "<summary>LIENS</summary>";
                        echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart1'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 1)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart2'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 2)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart3'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 3)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart4'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 4)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart5'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 5)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart6'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 6)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart7'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 7)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart8'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 8)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart9'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 9)'>";
                        echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype3['refart10'], ENT_QUOTES)."'
                        onchange='save_lien(".$datatype3['son'].", this.value, 10)'>";
                    echo "</details>";
                    echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                    onclick='ajou_prod(".$datatype3['son'].")'>";
                    echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                } else {
                    /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                    onclick='ajou_cat(".$datatype3['son'].")'>";
                    echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
                    /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                    onclick='ajou_groupe(".$datatype3['son'].")'>";
                    echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
                    /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                    onclick='ajou_prod(".$datatype3['son'].")'>";
                    echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                    $supprimable = true;
                    $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype3['son']."'");
                    while ($dataexist = $retourexist->fetch()){
                        $supprimable = false;
                    }
                }
                if($supprimable === true) {
                    echo "<img src='Images/Plus_poubelle.png' id='".$datatype3['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
                    onclick='Supprimer_base(".$datatype3['son'].")'>";
                } else {
                    echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
                }
                echo "</div>";
                $retourtype4 = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
                , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
                , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
                FROM arborescence
                LEFT JOIN produits
                ON arborescence.son = produits.IDProduit
                LEFT JOIN details_chantier
                ON details_chantier.IDProduit = produits.IDProduit
                WHERE dad = '".$datatype3['son']."'
                GROUP BY arborescence.son
                ORDER BY arborescence.type, produits.description");
                while ($datatype4 = $retourtype4->fetch()){
                    if ($datatype4['type'] == 'A'){
                        $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                        echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']."' style='margin-left: 20vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                        echo "<img src='Images/Deplacer.png' id='".$datatype4['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                        ondragstart='Copier(event)'
                        ondblclick='afficher_cat(".$datatype4['son'].")'>";
                        /*echo "<img src='Images/Cible.png' id='".$datatype4['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                        ondrop='Coller(event)'
                        ondragover='allowDrop(event)'>";*/
                    /*} elseif ($datatype4['type'] == 'G'){
                        $color = " color: #7a3aa0; background-color: #7a3aa070;";
                        echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']."' style='margin-left: 20vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                        echo "<img src='Images/Deplacer.png' id='".$datatype4['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                        ondragstart='Copier(event)'
                        ondblclick='afficher_cat(".$datatype4['son'].")'>";
                        //echo "<img src='Images/Cible.png' id='".$datatype4['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                        ondrop='Coller(event)'
                        ondragover='allowDrop(event)'>";*/
                    } else {
                        $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
                        echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']."' style='margin-left: 20vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                        echo "<img src='Images/Deplacer.png' id='".$datatype4['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                        ondragstart='Copier(event)'
                        ondblclick='afficher_cat(".$datatype4['son'].")'>";
                        echo "<img src='Images/Cible.png' id='".$datatype4['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                        ondrop='Coller(event)'
                        ondragover='allowDrop(event)'>";
                    }            
                    if ($datatype4['utilis'] > 0) {
                        $supprimable = false;
                        $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                        echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype4['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype4['utilis']." fois'
                        onchange='save_description_produit(".$datatype4['son'].", this.value)'>";
                    } else {
                        $supprimable = true;
                        echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype4['description'], ENT_QUOTES)."'
                        onchange='save_description_produit(".$datatype4['son'].", this.value)'>";
                    }
                    if ($datatype4['type'] == 'A'){
                        echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype4['unite'], ENT_QUOTES)."'
                        onchange='save_unite_produit(".$datatype4['son'].", this.value)'>";
                        echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype4['tarif'], ENT_QUOTES)."'
                        onchange='save_tarif_base_produit(".$datatype4['son'].", this.value)'> €";
                        echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                        echo "<summary>LIENS</summary>";
                            echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart1'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 1)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart2'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 2)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart3'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 3)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart4'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 4)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart5'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 5)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart6'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 6)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart7'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 7)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart8'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 8)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart9'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 9)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart10'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 10)'>";
                        echo "</details>";
                    /*} elseif ($datatype4['type'] == 'G'){
                        echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype4['unite'], ENT_QUOTES)."'
                        onchange='save_unite_produit(".$datatype4['son'].", this.value)'>";
                        echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype4['tarif'], ENT_QUOTES)."'
                        onchange='save_tarif_base_produit(".$datatype4['son'].", this.value)'> €";
                        echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                        echo "<summary>LIENS</summary>";
                            echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart1'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 1)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart2'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 2)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart3'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 3)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart4'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 4)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart5'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 5)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart6'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 6)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart7'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 7)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart8'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 8)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart9'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 9)'>";
                            echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype4['refart10'], ENT_QUOTES)."'
                            onchange='save_lien(".$datatype4['son'].", this.value, 10)'>";
                        echo "</details>";
                        echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                        onclick='ajou_prod(".$datatype4['son'].")'>";
                        echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                    } else {
                        /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                        onclick='ajou_cat(".$datatype4['son'].")'>";
                        echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
                        /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                        onclick='ajou_groupe(".$datatype4['son'].")'>";
                        echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
                        /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                        onclick='ajou_prod(".$datatype4['son'].")'>";
                        echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                        $supprimable = true;
                        $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype4['son']."'");
                        while ($dataexist = $retourexist->fetch()){
                            $supprimable = false;
                        }
                    }
                    if($supprimable === true) {
                        echo "<img src='Images/Plus_poubelle.png' id='".$datatype4['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
                        onclick='Supprimer_base(".$datatype4['son'].")'>";
                    } else {
                        echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
                    }
                    echo "</div>";
                    $retourtype5 = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
                    , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
                    , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
                    FROM arborescence
                    LEFT JOIN produits
                    ON arborescence.son = produits.IDProduit
                    LEFT JOIN details_chantier
                    ON details_chantier.IDProduit = produits.IDProduit
                    WHERE dad = '".$datatype4['son']."'
                    GROUP BY arborescence.son
                    ORDER BY arborescence.type, produits.description");
                    while ($datatype5 = $retourtype5->fetch()){
                        if ($datatype5['type'] == 'A'){
                            $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                            echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']."' style='margin-left: 25vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                            echo "<img src='Images/Deplacer.png' id='".$datatype5['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                            ondragstart='Copier(event)'
                            ondblclick='afficher_cat(".$datatype5['son'].")'>";
                            /*echo "<img src='Images/Cible.png' id='".$datatype5['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                            ondrop='Coller(event)'
                            ondragover='allowDrop(event)'>";*/
                        /*} elseif ($datatype5['type'] == 'G'){
                            $color = " color: #7a3aa0; background-color: #7a3aa070;";
                            echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']."' style='margin-left: 25vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                            echo "<img src='Images/Deplacer.png' id='".$datatype5['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                            ondragstart='Copier(event)'
                            ondblclick='afficher_cat(".$datatype5['son'].")'>";
                            //echo "<img src='Images/Cible.png' id='".$datatype5['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                            ondrop='Coller(event)'
                            ondragover='allowDrop(event)'>";*/
                        } else {
                            $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
                            echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']."' style='margin-left: 25vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                            echo "<img src='Images/Deplacer.png' id='".$datatype5['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                            ondragstart='Copier(event)'
                            ondblclick='afficher_cat(".$datatype5['son'].")'>";
                            echo "<img src='Images/Cible.png' id='".$datatype5['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                            ondrop='Coller(event)'
                            ondragover='allowDrop(event)'>";
                        }                
                        if ($datatype5['utilis'] > 0) {
                            $supprimable = false;
                            $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                            echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype5['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype5['utilis']." fois'
                            onchange='save_description_produit(".$datatype5['son'].", this.value)'>";
                        } else {
                            $supprimable = true;
                            echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype5['description'], ENT_QUOTES)."'
                            onchange='save_description_produit(".$datatype5['son'].", this.value)'>";
                        }
                        if ($datatype5['type'] == 'A'){
                            echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype5['unite'], ENT_QUOTES)."'
                            onchange='save_unite_produit(".$datatype5['son'].", this.value)'>";
                            echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype5['tarif'], ENT_QUOTES)."'
                            onchange='save_tarif_base_produit(".$datatype5['son'].", this.value)'> €";
                            echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                            echo "<summary>LIENS</summary>";
                                echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart1'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 1)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart2'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 2)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart3'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 3)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart4'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 4)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart5'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 5)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart6'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 6)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart7'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 7)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart8'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 8)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart9'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 9)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart10'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 10)'>";
                            echo "</details>";
                        /*} elseif ($datatype5['type'] == 'G'){
                            echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype5['unite'], ENT_QUOTES)."'
                            onchange='save_unite_produit(".$datatype5['son'].", this.value)'>";
                            echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype5['tarif'], ENT_QUOTES)."'
                            onchange='save_tarif_base_produit(".$datatype5['son'].", this.value)'> €";
                            echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                            echo "<summary>LIENS</summary>";
                                echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart1'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 1)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart2'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 2)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart3'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 3)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart4'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 4)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart5'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 5)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart6'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 6)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart7'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 7)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart8'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 8)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart9'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 9)'>";
                                echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype5['refart10'], ENT_QUOTES)."'
                                onchange='save_lien(".$datatype5['son'].", this.value, 10)'>";
                            echo "</details>";
                            echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                            onclick='ajou_prod(".$datatype5['son'].")'>";
                            echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                        } else {
                            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                            onclick='ajou_cat(".$datatype5['son'].")'>";
                            echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
                            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                            onclick='ajou_groupe(".$datatype5['son'].")'>";
                            echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
                            /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                            onclick='ajou_prod(".$datatype5['son'].")'>";
                            echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                            $supprimable = true;
                            $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype5['son']."'");
                            while ($dataexist = $retourexist->fetch()){
                                $supprimable = false;
                            }
                        }
                        if($supprimable === true) {
                            echo "<img src='Images/Plus_poubelle.png' id='".$datatype5['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
                            onclick='Supprimer_base(".$datatype5['son'].")'>";
                        } else {
                            echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
                        }
                        echo "</div>";
                        $retourtype6 = $base->query("SELECT arborescence.id, arborescence.dad, arborescence.type, arborescence.son, produits.description
                        , produits.unite, produits.tarif, SUM(details_chantier.quantite) As utilis, produits.refart1, produits.refart2, produits.refart3, produits.refart4, produits.refart5
                        , produits.refart6, produits.refart7, produits.refart8, produits.refart9, produits.refart10
                        FROM arborescence
                        LEFT JOIN produits
                        ON arborescence.son = produits.IDProduit
                        LEFT JOIN details_chantier
                        ON details_chantier.IDProduit = produits.IDProduit
                        WHERE dad = '".$datatype5['son']."'
                        GROUP BY arborescence.son
                        ORDER BY arborescence.type, produits.description");
                        while ($datatype6 = $retourtype6->fetch()){
                            if ($datatype6['type'] == 'A'){
                                $color = " border: solid 1px rgb(21, 114, 185); border-left: solid 10px rgb(21, 114, 185); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                                echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']." ".$datatype5['son']."' style='margin-left: 30vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                                echo "<img src='Images/Deplacer.png' id='".$datatype6['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                                ondragstart='Copier(event)'
                                ondblclick='afficher_cat(".$datatype6['son'].")'>";
                                /*echo "<img src='Images/Cible.png' id='".$datatype6['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                                ondrop='Coller(event)'
                                ondragover='allowDrop(event)'>";*/
                            /*} elseif ($datatype6['type'] == 'G'){
                                $color = " color: #7a3aa0; background-color: #7a3aa070;";
                                echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']." ".$datatype5['son']."' style='margin-left: 30vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                                echo "<img src='Images/Deplacer.png' id='".$datatype6['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                                ondragstart='Copier(event)'
                                ondblclick='afficher_cat(".$datatype6['son'].")'>";
                                //echo "<img src='Images/Cible.png' id='".$datatype6['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                                ondrop='Coller(event)'
                                ondragover='allowDrop(event)'>";*/
                            } else {
                                $color = " border: solid 1px rgb(0 0 0); border-left: solid 10px rgb(0 0 0); background-color: rgba(0, 0, 0, 0.4); color: white; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;";
                                echo "<div class='N0 ".$datatype['son']." ".$datatype2['son']." ".$datatype3['son']." ".$datatype4['son']." ".$datatype5['son']."' style='margin-left: 30vw; border-top: solid 0px grey; margin-top: 2px; display: none; align-items: center;'>";
                                echo "<img src='Images/Deplacer.png' id='".$datatype6['son']."' class='fleche' title='Déplacer vers la cible' style='height: 20px; margin-right: 5px' draggable='true'
                                ondragstart='Copier(event)'
                                ondblclick='afficher_cat(".$datatype6['son'].")'>";
                                echo "<img src='Images/Cible.png' id='".$datatype6['son']."' class='cible' title='Coller' style='height: 20px; margin-right: 5px; display: none;'
                                ondrop='Coller(event)'
                                ondragover='allowDrop(event)'>";
                            }                    
                            if ($datatype6['utilis'] > 0) {
                                $supprimable = false;
                                $color = " border: solid 1px rgb(255 118 0); border-left: solid 10px rgb(255 118 0); background-color: rgba(21, 114, 185, 0.4); border-radius: 5px; box-shadow: rgba(21, 114, 185, 0.4) 0px 2px 4px, rgba(21, 114, 185, 0.3) 0px 7px 13px -3px, rgba(21, 114, 185, 0.2) 0px -3px 0px inset;";
                                echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype6['description'], ENT_QUOTES)."' title='ATTENTION produit utilisé ".$datatype6['utilis']." fois'
                                onchange='save_description_produit(".$datatype6['son'].", this.value)'>";
                            } else {
                                $supprimable = true;
                                echo "<input type='text' size='30' style='".$color." padding: 2px; border-radius: 5px;' value='".htmlspecialchars($datatype6['description'], ENT_QUOTES)."'
                                onchange='save_description_produit(".$datatype6['son'].", this.value)'>";
                            }
                            if ($datatype6['type'] == 'A'){
                                echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype6['unite'], ENT_QUOTES)."'
                                onchange='save_unite_produit(".$datatype6['son'].", this.value)'>";
                                echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype6['tarif'], ENT_QUOTES)."'
                                onchange='save_tarif_base_produit(".$datatype6['son'].", this.value)'> €";
                                echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                                echo "<summary>LIENS</summary>";
                                    echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart1'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 1)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart2'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 2)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart3'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 3)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart4'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 4)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart5'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 5)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart6'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 6)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart7'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 7)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart8'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 8)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart9'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 9)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart10'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 10)'>";
                                echo "</details>";
                            /*} elseif ($datatype6['type'] == 'G'){
                                echo "<input type='text' style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 70px;' list='defaultNumbers' value='".htmlspecialchars($datatype6['unite'], ENT_QUOTES)."'
                                onchange='save_unite_produit(".$datatype6['son'].", this.value)'>";
                                echo "<input type='number' min='0' step='0.01' style='".$color." padding: 2px; text-align: right; border-radius: 5px; margin-left: 10px; width: 70px;' value='".htmlspecialchars($datatype6['tarif'], ENT_QUOTES)."'
                                onchange='save_tarif_base_produit(".$datatype6['son'].", this.value)'> €";
                                echo "<details style='".$color." padding: 2px; text-align: center; border-radius: 5px; margin-left: 10px; width: 200px;'>";
                                echo "<summary>LIENS</summary>";
                                    echo "<input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart1'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 1)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart2'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 2)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart3'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 3)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart4'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 4)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart5'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 5)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart6'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 6)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart7'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 7)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart8'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 8)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart9'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 9)'>";
                                    echo "<br><input type='text' style='font-size: small; ".$color." padding: 2px; border-radius: 5px; margin-left: 10px; width: calc(200px - 25px);' value='".htmlspecialchars($datatype6['refart10'], ENT_QUOTES)."'
                                    onchange='save_lien(".$datatype6['son'].", this.value, 10)'>";
                                echo "</details>";
                                echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                                onclick='ajou_prod(".$datatype6['son'].")'>";
                                echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                            } else {
                                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter une catégorie' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                                onclick='ajou_cat(".$datatype6['son'].")'>";
                                echo "<a style='color: #47ab45; font-weight: bold;'> Ajouter une catégorie</a>";*/
                                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un groupe' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                                onclick='ajou_groupe(".$datatype6['son'].")'>";
                                echo "<a style='color: #7a3aa0; font-weight: bold;'> Ajouter un groupe</a>";*/
                                /*echo "<input type='image' value='' src='Images/Plus.png' title='Ajouter un produit' style='height: 20px; margin-right: 5px; margin-left: 20px;'
                                onclick='ajou_prod(".$datatype6['son'].")'>";
                                echo "<a style='color: #0c73b8; font-weight: bold;'> Ajouter un article</a>";*/
                                $supprimable = true;
                                $retourexist = $base->query("SELECT id FROM arborescence WHERE dad = '".$datatype6['son']."'");
                                while ($dataexist = $retourexist->fetch()){
                                    $supprimable = false;
                                }
                            }
                            if($supprimable === true) {
                                echo "<img src='Images/Plus_poubelle.png' id='".$datatype6['son']."' class='cible' title='Supprimer' style='height: 20px; margin-right: 5px;'
                                onclick='Supprimer_base(".$datatype6['son'].")'>";
                            } else {
                                echo "<img src='Images/No_poubelle.png' class='cible' title='Non supprimable car utilisé' style='height: 20px; margin-right: 5px;'>";
                            }
                            echo "</div>";
                        }
                    }    
                }    
            }    
        }
    }
echo "</div>";
?>