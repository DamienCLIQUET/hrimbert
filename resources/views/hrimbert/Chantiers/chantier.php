<?php
session_start();
include('../config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <title>Hervé RIMBERT</title>
        <link rel ="stylesheet" href="../css/HRimbertChantier.css" />
        <link rel ="stylesheet" href="../css/HRimbertChantier-tab.css" />
        <link rel ="stylesheet" href="../css/HRimbertChantier-gsm.css" />
        <link rel="icon" href="../Images/Icone.png"/>
        <script src="https://kit.fontawesome.com/0b84318fd8.js" crossorigin="anonymous"></script>
    </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <body>
        <?php
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
                <input type='button' value='Se connecter' class='favorite Button_connection'
                onclick='connect()'>
            </div>
            <?php
        /*Si utilisateur connecté*/
        } else {
            $IDChantier = $_GET['IDChantier'];
            $retourchantier = $base->query("SELECT client, chantier, commentaire, statut, creation
            FROM chantier
            WHERE IDChantier = '".$IDChantier."'");
            while ($datachantier = $retourchantier->fetch()){
                $client = $datachantier['client'];
                $chantier = $datachantier['chantier'];
                $commentaire = htmlspecialchars($datachantier['commentaire'], ENT_QUOTES);
                $statut = $datachantier['statut'];
            }
            ?>
            <div class='corps'>
                <div id='chargement' class='chargement'>
                    <img src='../Images/Chargement.gif'>
                </div>
                <div id='header' class='header'>
                    <div>
                        <a href="../index.php" style='margin: 0;'><i class="fa-solid fa-rectangle-list fa-2xl" title='Liste des chantiers'></i></a>
                    </div>
                    <div class='header_titre'>
                        <a>Hervé RIMBERT</a>
                    </div>
                    <div class='header_menu'>
                        <i class='fa-regular fa-copy fa-2xl' title='Cloner le chantier'
                        onclick='copier_chantier(<?php echo $IDChantier; ?>)'></i>
                        <i class='fa-regular fa-trash-can fa-2xl' title='Supprimer le chantier'
                        onclick='supprimer_chantier(<?php echo $IDChantier; ?>)'></i>
                    </div>
                </div>
                <div class='chantier_entete'>
                    <?php
                    if ($_SESSION["ModifCategoriehr"] == '1'){
                    ?>
                        <select style='width: 100%;' id='statut'
                        onchange='save_statut(this.value, <?php echo $IDChantier; ?>)'>
                        <?php
                        $retourtype = $base->query("SELECT *
                        FROM categories
                        ORDER BY ordre");
                        while ($datatype = $retourtype->fetch()){
                            if ($datatype['IDType'] != $statut){
                                echo '<option value="',$datatype['IDType'],'" class="chantier'.$datatype['IDType'].'">',$datatype['type'],'</option>';
                            } else {
                                echo '<option value="',$datatype['IDType'],'" class="chantier'.$datatype['IDType'].'" selected>',$datatype['type'],'</option>';
                            }
                        }
                        ?>
                        </select>
                    <?php
                    } else {
                        ?>
                        <select style='width: 100%;' id='statut'>
                        <?php
                        $retourtype = $base->query("SELECT *
                        FROM categories
                        ORDER BY ordre");
                        while ($datatype = $retourtype->fetch()){
                            if ($datatype['IDType'] == $statut){
                                echo '<option value="',$datatype['IDType'],'" class="chantier'.$datatype['IDType'].'" selected>',$datatype['type'],'</option>';
                            }
                        }
                        ?>
                        </select>
                    <?php
                    }

                    if ($_SESSION["ModifCategoriehr"] == '1'){
                        $modifiable = '';
                    } else {
                        $modifiable = ' readonly="readonly"';
                    }
                    ?>
                    <input type='hidden' id='IDChantier' value='<?php echo $IDChantier; ?>'>
                    <input type='text' id='client' value='<?php echo $client; ?>' title='Nom du client' placeholder='Nom du client' <?php echo $modifiable; ?> style='width: calc(100% - 6px);'
                    onchange='save_entete(<?php echo $IDChantier; ?>)'
                    onKeypress='return valid_mail(event)'>
                    <input type='text' id='chantier' value='<?php echo $chantier; ?>' title='Nature du chantier' placeholder='Nature du chantier' <?php echo $modifiable; ?> style='width: calc(100% - 6px);'
                    onchange='save_entete(<?php echo $IDChantier; ?>)'
                    onKeypress='return valid_mail(event)'>
                    <div style='display: flex; flex-direction: row;'>
                        <input type='button' id='details' value='Détails' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("details")'><i class='fa-solid fa-info'></i></div>
                        <input type='button' id='produits' value='Produits' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("produits")'><i class='fa-solid fa-plug'></i></div>
                        <input type='button' id='actions' value='Actions' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("actions")'><i class='fa-solid fa-calendar-days'></i></div>
                        <input type='button' id='pieces_jointes' value='Pièces jointes' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("pieces_jointes")'><i class='fa-solid fa-file'></i></div>
                        <input type='button' id='photos' value='Photos' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("photos")'><i class='fa-solid fa-image'></i></div>
                        <input type='button' id='plans' value='Plans' class='styledOnglet destop' onclick='onglets(this.id)'>
                        <div class='styledOnglet mobile'
                        onclick='onglets("plans")'><i class='fa-solid fa-map'></i></div>
                    </div>
                </div>
                <div id='chantier_details'>

                </div>
            </div>
        <?php
        }
        ?>
        <div id='new_titre'>

        </div>
        <div id='liste_produits'>

        </div>
        <div id='new_action'>

        </div>
        <div id='afficher_photo'>

        </div>
        <div id='fiche_produit'>

        </div>
    </body>
    <script src='../index.js'></script>
    <script src='../onglet.js'></script>
</html>