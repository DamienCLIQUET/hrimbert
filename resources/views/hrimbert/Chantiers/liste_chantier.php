<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

/*Vérification de connection*/
$connection = 0;
/*Si aucun utilisateur connecté*/
if(!isset($_SESSION["userhr"]) OR !isset($_SESSION["passhr"]) OR !isset($_SESSION["profilhr"])) {
    $connection = 0;
/*Si utilisateur déjà connecté*/
} else {
    $retour_connect = $base->query("SELECT profil
    FROM utilisateurs
    WHERE userhr = '".$_SESSION["userhr"]."' AND passhr = '".$_SESSION["passhr"]."'");
    while ($data_connect = $retour_connect->fetch()) {
        /*Si user, pass et profil OK*/
        if ($_SESSION["profilhr"] === $data_connect['profil']) {
            $connection = $data_connect['profil'];
        /*Si user ou pass ou actif non OK*/
        } else {
            $connection = 0;
        }
    }
}
/*Si utilisateur non connecté*/
if ($connection == 0) {
    ?>
    <div class='connection'>
        <p>Identification</p>
        <input type='text' id='userhr' placeholder='Nom utilisateur'>
        <input type='password' id='passhr' placeholder='Entrer votre mot de passe'>
        <input type='button' value='Se connecter' class='favorite connection_button' onclick='connect()'>
    </div>
    <?php
/*Si utilisateur connecté*/
} else {
    ?>
    <div id='header' class='header'>
        <div class='header_menu'>
            <?php
            if ($_POST['trier'] == 'date'){
                ?>
                <a href="index.php" id='logo_trier_az' style='margin: 0; text-decoration: none;'><i class="fa-solid fa-arrow-down-a-z fa-xl" title='Trier par ordre alphabétique'></i></a>
                <a href="index.php?trier=date" id='logo_trier_date' style='margin: 0; text-decoration: none; display: none;'><i class="fa-regular fa-calendar-days fa-xl" title='Trier par date'></i></a>
                <?php
            } else {
                ?>
                <a href="index.php" id='logo_trier_az' style='margin: 0; text-decoration: none; display: none;'><i class="fa-solid fa-arrow-down-a-z fa-xl" title='Trier par ordre alphabétique'></i></a>
                <a href="index.php?trier=date" id='logo_trier_date' style='margin: 0; text-decoration: none;'><i class="fa-regular fa-calendar-days fa-xl" title='Trier par date'></i></a>
                <?php
            }
            ?>
        </div>
        <div class='header_titre'>
            <a id='herverimbert'>Hervé RIMBERT</a>
            <input type='text' id='rechercher' style='border-radius: 10px; padding: 3px; max-width: calc(100vw - 250px);' placeholder='Rechercher un chantier'
            onkeyup='recherche(this.value)'>
        </div>
        <div class='header_menu'>
            <a href="index.php" id='logo_chantier' style='margin: 0; display: none; text-decoration: none;'><i class="fa-solid fa-helmet-safety fa-xl" title='Liste des chantiers'></i></a>
            <i class="fa-regular fa-hourglass-half fa-xl" id='logo_heures' title='Heures de travail'
            onclick='heures()'></i>
            <?php
            /*Si utilisateur autorisé à voir menu Produits*/
            if ($_SESSION["VoirMenuProduitshr"] == '1'){
                ?>
                <i class="fa-solid fa-toolbox fa-xl" id='logo_articles' title='Gestion des articles' onclick='Liste_produits(0)'></i>
                <?php
            }
            /*Si utilisateur autorisé à voir menu Paramètres*/
            if ($_SESSION["VoirMenuParametreshr"] == '1'){
                ?>
                <a href="administration.php" target='_blank'>
                    <i class="fa-solid fa-screwdriver-wrench fa-xl" title='Paramètres'></i>
                </a>
                <?php
            }
            ?>
            <i class="fa-solid fa-right-from-bracket fa-xl" title='Déconnection'
            onclick='deconnection()'></i>
        </div>
    </div>
    <div id='chantiers'>
    <?php
        $retourtype = $base->query("SELECT IDType, type
        FROM categories
        ORDER BY ordre");
        while ($datatype = $retourtype->fetch()){
            $categorie = $datatype['IDType'];
            $type = $datatype['type'];
            /*Si utilisateur autorisé à voir categorie X*/
            if ($_SESSION["VoirCategorie".$categorie."hr"] == '1'){
                ?>
                <div class='tableaudetail'>
                <?php
                    if ($_POST['trier'] == 'date'){
                        $retourchantier = $base->query("SELECT chantier.IDChantier, chantier.client, chantier.chantier, chantier.tva, chantier.paye, MAX(actions.date) As dernier
                        FROM chantier
                        INNER JOIN actions
                        ON chantier.IDChantier = actions.IDChantier
                        WHERE chantier.statut = '".$categorie."' AND statut <> '25'
                        GROUP BY actions.IDChantier
                        ORDER BY dernier DESC");
                    } elseif ($_POST['trier'] == 'alpha'){
                        $retourchantier = $base->query("SELECT IDChantier, client, chantier, tva, paye
                        FROM chantier
                        WHERE statut = '".$categorie."' AND statut <> '25'
                        ORDER BY client");
                    }
                    $count = $retourchantier->rowCount();
                    /*Si utilisateur categorie X developpée*/
                    if ($_SESSION["VoirCategorie".$categorie."hr"] == '0'){
                        ?>
                        <div class='titrechantier<?php echo $categorie; ?>'><b style='text-align: center;'><?php echo $count; ?> <?php echo $type; ?></b></div>
                        <div id='chantier<?php echo $categorie; ?>' class='leschantiers'>
                        </div>
                        <?php
                    } else {
                        if ($categorie != '25'){
                            ?>
                            <div class='titrechantier<?php echo $categorie; ?>'><b style='text-align: center;'><?php echo $count; ?> <?php echo $type; ?></b></div>
                            <?php
                        } else {
                            ?>
                            <div class='titrechantier<?php echo $categorie; ?>' onclick='chantier_autres();'><b
                            style='text-align: center;
                            cursor: pointer;'><?php echo $count; ?> <?php echo $type; ?></b></div>
                            <?php
                        }
                        ?>
                        <div id='chantier<?php echo $categorie; ?>' class='leschantiers'>
                        <?php
                            $total_categorie = 0;
                            while ($datachantier = $retourchantier->fetch()){
                                $IDChantier = $datachantier['IDChantier'];
                                $Label_client = $datachantier['client'];
                                $Label_chantier = $datachantier['chantier'];
                                $tva = $datachantier['tva'];
                                $paye = $datachantier['paye'];
                                $retour_avancement_chantier = $base->query("SELECT (SUM(avancement) / COUNT(quantite)) As avancement, SUM(quantite * tarif * (100 - remise) / 100) As total
                                FROM details_chantier
                                WHERE IDChantier = '".$IDChantier."'");
                                while ($data_avancement_chantier = $retour_avancement_chantier->fetch()){
                                    $avancement_total = $data_avancement_chantier['avancement'];
                                    $total_chantier = $data_avancement_chantier['total'] - $paye;
                                    $total_categorie += $data_avancement_chantier['total'] - $paye;
                                }
                                echo "<div class='quelchantier ".$Label_client." ".$Label_chantier."'>";
                                echo "<form method='get' action='Chantiers/chantier.php'>";
                                    echo "<input type='hidden' name='IDChantier' value='".$IDChantier."'>";
                                    /*Si categorie en cours afficher état d'avancement*/
                                    if ($categorie == '7') {
                                        echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."' style='background: linear-gradient(90deg, #8aff8a ".$avancement_total."%, white 0%);'>";
                                    } elseif (substr($Label_chantier, -6) == 'URGENT') {
                                        echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."URGENT'>";
                                    } else {
                                        echo "<input type='submit' value='".$Label_client." - ".$Label_chantier."' class='chantier".$categorie."'>";
                                    }
                                echo "</form>";
                                /*Si autorisé à voir action*/
                                if ($_SESSION["VoirActionhr"] == '1'){
                                    $retouraction = $base->query("SELECT type, date, commentaire
                                    FROM actions
                                    WHERE IDChantier = '".$IDChantier."' ORDER BY date DESC LIMIT 1");
                                    while ($dataaction = $retouraction->fetch()){
                                        echo "<div class='action'>";
                                        echo "<i class='fa-solid fa-calendar-minus fa-xs'></i>";
                                        echo "<a class='action_action'>".date('d/m/y', strtotime($dataaction['date']))." ".$dataaction['type']." : ".htmlspecialchars($dataaction['commentaire'], ENT_QUOTES)."</a>";
                                        /*Si autorisé à voir tarif action*/
                                        if ($_SESSION["VoirTarifhr"] == '1'){
                                            echo "<a class='action_tarif'>".intval($total_chantier * (100 + floatval($tva)) / 100)."€ TTC</a>";
                                        }
                                        echo "</div>";
                                    }
                                }
                                echo "</div>";
                            }
                        echo "</div>";
                        if ($categorie != '25'){
                            echo "<center style='display: flex; align-items: center; justify-content: center;'>";
                            /*Si autorisé à ajouter un chantier*/
                            if ($_SESSION["AjoutCategorie".$categorie."hr"] == '1'){
                                ?>
                                <i class='fa-solid fa-circle-plus' title='Ajouter un <?php echo $type; ?>'
                                style='margin-right: 5px;'
                                onclick='new_chantier("<?php echo $categorie; ?>")'></i>
                                <?php
                            }
                            /*Si autorisé à voir total HT catégorie*/
                            if ($_SESSION["VoirTarifhr"] == '1'){
                                echo intval($total_categorie)."€ HT";
                            }
                            echo "</center>";
                        }
                    }
                echo "</div>";
            }
        }
    ?>
    </div>
    <div id='new_chantier'>

    </div>
    <?php
}
?>