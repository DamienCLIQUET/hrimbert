<?php
    include('config.php');
    include('List.php');

    $niveau = $_POST['niveau'];
    echo "<div style='width: 100%; display: flex; align-items: center; justify-content: flex-end;'>";
        echo "<input type='button' class='styledBouton2' value='X' title='Fermer' onclick='fermers()'>";
    echo "</div>";
    echo "<div class='styledBouton produi' style='margin-bottom: 100px;'>";
        echo "<div style='display: flex; align-content: center; margin-right: 5px;'>";
            echo "<img src='Images/Plus.png' id='new_produit' placeholder='Ajouter un article' style='max-width: 50px;' onclick='add_new(".$niveau.")'>";
        echo "</div>";
        echo "<div>";
            echo "<div>";
                echo "<input type='text' id='description' value='' placeholder='Description' style='background-color: rgba(255, 255, 255, 0.9); color: black; width: 100%;'>";
            echo "</div>";
            echo "<div style='display: flex;
            flex-wrap: nowrap;
            justify-content: space-around;'>";
                echo "<div style='width: 50%'><input type='text' id='unite' value='' size='4' placeholder='Unité' list='defaultNumbers' style='
                background-color: rgba(255, 255, 255, 0.9);
                color: black;
                width: 100%;
                text-align: center;'></div>";
                echo "<div style='width: 50%'><input type='number' id='tarif' step='0.01' value='' size='4' placeholder='Tarif de base' style='
                text-align: center;
                background-color: rgba(255, 255, 255, 0.9);
                color: black;
                width: 100%;'></div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
?>