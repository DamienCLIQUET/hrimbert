<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <title>Hervé RIMBERT - Administration</title>
		<link rel ="stylesheet" href="css/HRimbert.css" />
		<link rel ="stylesheet" href="css/HRimbert-tab.css" />
		<link rel ="stylesheet" href="css/HRimbert-gsm.css" />
		<link rel="icon" href="Images/Icone.png"/>
        <script src="https://kit.fontawesome.com/0b84318fd8.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='index.js'></script>
    </head>
    <?php
    session_start();
    include('config.php');

    ?>
    <body style='display: flex; flex-direction: column; align-items: center;'>
        <?php
        if ($_SESSION["VoirMenuParametreshr"] == '1') {
            echo "<div style='background-color: lightslategrey; margin: 5px; width: fit-content; padding: 5px; border-radius: 40px 40px 0 0;'>";
                echo "<h1 style='color: white; text-align: center;'>Utilisateurs</h1>";
                echo "<div style='margin: 2px; background-color: white; width: fit-content;'>";
                    echo "<table>";
                        echo "<tr>";
                            echo "<th style='text-align: center; border: solid 1px black;'>";
                                echo "<p>User</p>";
                            echo "</th>";
                            echo "<th style='text-align: center; border: solid 1px black;'>";
                                echo "<p>Mot de passe</p>";
                            echo "</th>";
                            echo "<th style='text-align: center; border: solid 1px black;'>";
                                echo "<p>Profil</p>";
                            echo "</th>";
                        echo "</tr>";
                        $retourutilisateurs = $base->query("SELECT *
                        FROM utilisateurs
                        WHERE utilisateurs.userhr <> 'DCLIQUET'
                        ORDER BY ID");
                        while ($datautilisateurs = $retourutilisateurs->fetch()){
                            $ID = $datautilisateurs['ID'];
                            $userhr = $datautilisateurs['userhr'];
                            $passhr = $datautilisateurs['passhr'];
                            $profil = $datautilisateurs['profil'];
                            echo "<tr>";
                                echo "<td>";
                                    ?>
                                    <input type='text' style='width: 99%;' value='<?php echo $userhr; ?>' onkeyup="save_profil('utilisateurs', 'userhr', 'ID', '<?php echo $ID; ?>', this.value)" />
                                    <?php
                                echo "</td>";
                                echo "<td>";
                                    ?>
                                    <input type='text' style='width: 99%;' value='<?php echo $passhr; ?>' onkeyup="save_profil('utilisateurs', 'passhr', 'ID', '<?php echo $ID; ?>', this.value)" />
                                    <?php
                                echo "</td>";
                                echo "<td>";
                                    ?>
                                    <select onchange="save_profil('utilisateurs', 'profil', 'ID', '<?php echo $ID; ?>', this.value)">
                                    <?php
                                    $retourprofils = $base->query("SELECT *
                                    FROM profils
                                    ORDER BY profils.profil");
                                    while ($dataprofils = $retourprofils->fetch()){
                                        $profilliste = $dataprofils['profil'];
                                        $designationliste = $dataprofils['designation'];
                                        if ($profilliste == $profil) {
                                            echo "<option value='".$profilliste."' selected>".$designationliste."</option>";
                                        } else {
                                            echo "<option value='".$profilliste."'>".$designationliste."</option>";
                                        }
                                    }
                                    echo "</select>";
                                echo "</td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                            echo "<td>";
                                ?>
                                <input type='text' id='newuser' style='width: 99%;
                                background-color: rgb(21, 114, 185);
                                color: white;' value='' />
                                <?php
                            echo "</td>";
                            echo "<td>";
                                ?>
                                <input type='text' id='newpass' style='width: 99%;
                                background-color: rgb(21, 114, 185);
                                color: white;' value='' />
                                <?php
                            echo "</td>";
                            echo "<td>";
                                ?>
                                <select id='newprofil' style='background-color: rgb(21, 114, 185);
                                color: white;'>
                                <?php
                                $retourprofils = $base->query("SELECT *
                                FROM profils
                                ORDER BY profils.profil");
                                while ($dataprofils = $retourprofils->fetch()){
                                    $profilliste = $dataprofils['profil'];
                                    $designationliste = $dataprofils['designation'];
                                    echo "<option value='".$profilliste."'>".$designationliste."</option>";
                                }
                                echo "</select>";
                            echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td colspan='3'>";
                                ?>
                                <input type='button' value="Créer l'utilisateur"
                                class="connection_button"
                                style='width: 100%; padding: 2px !important;' onclick="new_profil('utilisateurs')" />
                                <?php
                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</div>";
            echo "</div>";
            echo "<div style='background-color: lightslategrey; margin: 5px; width: fit-content; padding: 5px; border-radius: 40px 40px 0 0;'>";
                echo "<h1 style='color: white; text-align: center;'>Profils</h1>";
                echo "<div style='display: flex; margin: 5px; flex-wrap: wrap;'>";
                    $retourcategories = $base->query("SELECT *
                    FROM categories
                    ORDER BY IDType");
                    while ($datacategories = $retourcategories->fetch()){
                        $IDType = $datacategories['IDType'];
                        ${"type$IDType"} = $datacategories['type'];
                    }
                    $retourprofils = $base->query("SELECT *
                    FROM profils
                    WHERE profils.profil > 0");
                    while ($dataprofils = $retourprofils->fetch()){
                        $profil = $dataprofils['profil'];
                        $designation = $dataprofils['designation'];
                        $VoirMenuProduits = $dataprofils['VoirMenuProduits'];
                        $VoirMenuParametres = $dataprofils['VoirMenuParametres'];
                        for ($i = 1; $i < 10; $i++) {
                            ${"VoirCategorie$i"} = $dataprofils['VoirCategorie'.$i];
                            ${"AjoutCategorie$i"} = $dataprofils['AjoutCategorie'.$i];
                        }
                        $VoirCategorie20 = $dataprofils['VoirCategorie20'];
                        $AjoutCategorie20 = $dataprofils['AjoutCategorie20'];
                        $VoirCategorie25 = $dataprofils['VoirCategorie25'];
                        $AjoutCategorie25 = $dataprofils['AjoutCategorie25'];
                        $VoirAction = $dataprofils['VoirAction'];
                        $VoirTarif = $dataprofils['VoirTarif'];
                        $VoirAdmin = $dataprofils['VoirAdmin'];
                        $VoirPlan = $dataprofils['VoirPlan'];
                        $ModifCategorie = $dataprofils['ModifCategorie'];
                        echo "<div style='margin: 2px; background-color: white;'>";
                            echo "<h2 style='text-align: center;'>".$designation."</h2>";
                            echo "<table>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir le menu des produits</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirMenuProduits', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirMenuProduits == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir le menu des paramètres</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirMenuParametres', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirMenuParametres == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir les actions</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirAction', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirAction == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir les tarifs</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirTarif', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirTarif == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir les commentaires administratifs</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirAdmin', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirAdmin == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir les plans</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirPlan', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirPlan == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Modifier les catégories</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'ModifCategorie', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($ModifCategorie == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                for ($i = 1; $i < 10; $i++) {
                                    echo "<tr>";
                                        echo "<td style='border: solid 1px black;'>Voir categorie ".${"type$i"}."</td>";
                                        echo "<td>";
                                            ?>
                                            <select onchange="save_profil('profils', 'VoirCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                            <?php
                                            if (${"VoirCategorie$i"} == 0) {
                                                echo "<option value='0' selected>Non</option>";
                                                echo "<option value='1'>Oui</option>";
                                            } else {
                                                echo "<option value='0'>Non</option>";
                                                echo "<option value='1' selected>Oui</option>";
                                            }
                                            echo "</select>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir categorie ".$type20."</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirCategorie20 == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Voir categorie ".$type25."</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'VoirCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($VoirCategorie25 == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                for ($i = 1; $i < 10; $i++) {
                                    echo "<tr>";
                                        echo "<td style='border: solid 1px black;'>Ajouter chantier ".${"type$i"}."</td>";
                                        echo "<td>";
                                            ?>
                                            <select onchange="save_profil('profils', 'AjoutCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                            <?php
                                            if (${"AjoutCategorie$i"} == 0) {
                                                echo "<option value='0' selected>Non</option>";
                                                echo "<option value='1'>Oui</option>";
                                            } else {
                                                echo "<option value='0'>Non</option>";
                                                echo "<option value='1' selected>Oui</option>";
                                            }
                                            echo "</select>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Ajouter chantier ".$type20."</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'AjoutCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($AjoutCategorie20 == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td style='border: solid 1px black;'>Ajouter chantier ".$type25."</td>";
                                    echo "<td>";
                                        ?>
                                        <select onchange="save_profil('profils', 'AjoutCategorie<?php echo $i; ?>', 'profil', '<?php echo $profil; ?>', this.value)">
                                        <?php
                                        if ($AjoutCategorie25 == 0) {
                                            echo "<option value='0' selected>Non</option>";
                                            echo "<option value='1'>Oui</option>";
                                        } else {
                                            echo "<option value='0'>Non</option>";
                                            echo "<option value='1' selected>Oui</option>";
                                        }
                                        echo "</select>";
                                    echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                    }
                echo "</div>";
            echo "</div>";
        }
        ?>
    </body>
</html>