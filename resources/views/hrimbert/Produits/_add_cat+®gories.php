<?php
    include('../config.php');

    $niveau = $_POST['niveau'];
    echo "<div style='width: 100%; display: flex; align-items: center; justify-content: flex-end;'>";
        echo "<input type='button' class='styledBouton2' value='X' title='Fermer' onclick='fermers()'>";
    echo "</div>";
    echo "<div class='styledBouton produi'>";
        echo "<div style='display: flex; align-content: center; margin-right: 5px;'>";
            echo "<img src='Images/Plus.png' id='new_categorie' placeholder='Ajouter une catégorie' style='max-width: 50px;' onclick='add_new_categorie(".$niveau.")'>";
        echo "</div>";
        echo "<div style='width: 100%;'>";
            echo "<input type='text' id='categorie' value='' style='background-color: rgba(255, 255, 255, 0.9); color: black; width: 100%;'>";
        echo "</div>";
    echo "</div>";
?>