<?php
require __DIR__.'/../vendor/autoload.php';

use Nuzkito\ChromePdf\ChromePdf;
session_start();
include('../config.php');
ob_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <title>Rapport</title>
        <link rel ="stylesheet" href="../css/HRimbertChantier.css" />
        <link rel ="stylesheet" href="../css/HRimbertChantier-tab.css" />
        <link rel ="stylesheet" href="../css/HRimbertChantier-gsm.css" />
        <link rel="icon" href="../Images/Icone.png"/>
        <script src="https://kit.fontawesome.com/0b84318fd8.js" crossorigin="anonymous"></script>
    </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <body>
        <?php
        $IDChantier = $_POST['IDChantier'];
        $IDPlan = $_POST['IDPlan'];
        $IDPoint = " points.IDPoint = '".str_replace(",", "' OR points.IDPoint = '", $_POST['IDPoint'])."'";
        $page = 1;
        $retourpoints = $base->query("SELECT points.IDPoint, points.nbpoint, points.x, points.y, points.nompoint, points.commentaires
        , etats.nomEtat , etats.colorEtat, familles.nomFamille, chantier.client
        FROM points
        LEFT JOIN etats
        ON etats.IDEtat = points.IDEtat
        LEFT JOIN familles
        ON familles.IDFamille = points.IDFamille
        LEFT JOIN chantier
        ON chantier.IDChantier = '".$IDChantier."'
        WHERE ".$IDPoint."
        ORDER BY points.nbpoint");
        while ($datapoint = $retourpoints->fetch()){
            $IDPoint = $datapoint['IDPoint'];
            $colorEtat = $datapoint['colorEtat'];
            $nompoint = $datapoint['nompoint'];
            $nomEtat = $datapoint['nomEtat'];
            $commentaires = htmlspecialchars($datapoint['commentaires'], ENT_QUOTES);
            $client = $datapoint['client'];
            ?>
            <div style=''>
                <div style='display: flex;'>
                    <p style='text-align: center; font-size: 30px; width: 100%'><?php echo $client; ?></p>
                    <p style='margin: 3px 0; text-align: center; font-size: 30px;'><?php echo $page; ?></p>
                </div>
                <div style='    border-top: solid 1px black;
    display: flex;
    justify-content: space-between;
    width: 100%;'>
                    <div style='width: 60%;'>
                        <p style='margin: 3px 0;'><b>Titre : </b><?php echo $nompoint; ?></p>
                        <p style='margin: 3px 0;'><b>Etat : </b><?php echo $nomEtat; ?></p>
                        <p  style='margin-top: 3px; font-weight: bold;'>Commentaires : </p>
                        <p><?php echo $commentaires; ?></p>
                    </div>
                    <div style='max-width: 40%;'>
                        <?php
                        if (file_exists('../Plans/'.$IDChantier)) {
                            $nom_fichier = 999999;
                            $scandir = scandir('../Plans/'.$IDChantier."/");
                            foreach($scandir as $fichier){
                                if ($IDPlan == basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION))){
                                    $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                                }
                            }
                        }
                        list($width, $height, $type, $attr) = getimagesize('../Plans/'.$IDChantier.'/'.$IDPlan.'.'.$extension);
                        $haut = 300;
                        $larg = $width / $height;
                        $hauteur = 47;
                        $largeur = 30;
                        $retourpoint = $base->query("SELECT points.nbpoint, points.x, points.y, points.nompoint, points.IDEtat, points.IDFamille, etats.nomEtat, etats.colorEtat, familles.nomFamille
                        FROM points
                        LEFT JOIN etats
                        ON etats.IDEtat = points.IDEtat
                        LEFT JOIN familles
                        ON familles.IDFamille = points.IDFamille
                        WHERE points.IDPoint = '".$IDPoint."'");
                        $i = 0;
                        while ($datapoint = $retourpoint->fetch()){
                            $x = $datapoint['x'];
                            $y = $datapoint['y'];
                            $colorEtat = $datapoint['colorEtat'];
                        }
                        ?>
                        <div id="chantier_details_plan_canvas" style="position: relative;">
                            <img src='../Plans/<?php echo $IDChantier."/".$IDPlan.".".$extension; ?>'
                            style='max-height: <?php echo $haut; ?>px;'>
                            <div style='position: absolute;
                            background-image: url(../Images/Lieu<?php echo $colorEtat; ?>.png);
                            background-size: contain;
                            background-repeat: no-repeat;
                            width: 30px;
                            height: 47px;
                            left: calc(<?php echo $x; ?>% - <?php echo $largeur / 2; ?>px);
                            top: calc(<?php echo $y; ?>% - <?php echo $hauteur / 2; ?>px);
                            font-weight: bold;
                            display: flex;
                            justify-content: center;
                            align-items: flex-start;
                            flex-wrap: nowrap;
                            padding-top: 5px;
                            color: blue;'>
                            </div>
                        </div>
                    </div>
                </div>
                <div style='border-top: solid 1px black; page-break-after: always;'>
                    <p>Images : </p>
                    <div style='display: flex; flex-wrap: wrap;'>
                    <?php
                    if (file_exists("../Points/".$IDPoint."/") != false) {
                        $scandir = scandir("../Points/".$IDPoint."/");
                        foreach($scandir as $fichier){
                            if (substr($fichier, 0, 1) != '.' AND (pathinfo($fichier, PATHINFO_EXTENSION) == "jpg"
                            OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPG"
                            OR pathinfo($fichier, PATHINFO_EXTENSION) == "jpeg"
                            OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPEG"
                            OR pathinfo($fichier, PATHINFO_EXTENSION) == "png"
                            OR pathinfo($fichier, PATHINFO_EXTENSION) == "PNG")){
                                ?>
                                <img style='width: 49%;
                                max-height: 500px;
                                object-fit: contain;'
                                src='../Points/<?php echo $IDPoint."/".$fichier; ?>'/>
                                <?php
                            }
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>

            <?php
            $page++;
        }
        ?>
    </body>
</html>

<?php

$resultat = ob_get_flush();
$save_txt = fopen('rapport.html', 'w');
fwrite($save_txt, $resultat);
fclose($save_txt);

// By default it will search for Chrome in the default path in each OS,
$pdf = new ChromePdf();
// but you need it, you can specify the route to the binary.
//$pdf = new ChromePdf('/path/to/google-chrome');

// Route when PDF will be saved.
$pdf->output('D:/rapport.pdf');

// ... or pass a string containing the HTML.
$pdf->generateFromFile('rapport.html');