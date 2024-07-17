<?php
    echo "<datalist id='defaultNumbers'>";
        $retour_unite_produit = $base->query("SELECT unite
        FROM produits
        GROUP BY unite
        ORDER BY unite");
        while ($data_unite_produit = $retour_unite_produit->fetch()){
            echo "<option value='".$data_unite_produit['unite']."'>";
        }
    echo "</datalist>";
?>