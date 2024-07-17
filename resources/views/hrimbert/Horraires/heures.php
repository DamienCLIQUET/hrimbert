<?php
session_start();
include('../config.php');

date_default_timezone_set('Europe/Paris');
$user = 'DCLIQUET';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Temps de travail</title>
		<link rel ="stylesheet" href="css/HRimbert.css" />
		<link rel ="stylesheet" href="css/HRimbert-tab.css" />
		<link rel ="stylesheet" href="css/HRimbert-gsm.css" />
		<link rel="icon" href="Images/Icone.png"/>
        <script src="https://kit.fontawesome.com/0b84318fd8.js" crossorigin="anonymous"></script>
    </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='heures.js'></script>
    <body>
        <div id='corps' class='corps'>
            <?php
            for ($i = 0; $i < 20; $i++) {
                $date = date('Y-m-d', strtotime(date('Y-m-d'). ' - '.$i.' days'));
                $retour_existe = $base->query("SELECT ID
                FROM heures
                WHERE user = '".$user."' AND date = '".$date."'");
                if ($retour_existe->fetch() != false){
                    $retour_existe = $base->query("SELECT *
                    FROM heures
                    WHERE user = '".$user."' AND date = '".$date."'");
                    while ($dataheure = $retour_existe->fetch()){
                        $debutMatin = $dataheure['debutMatin'];
                        $finMatin = $dataheure['finMatin'];
                        $debutSoir = $dataheure['debutSoir'];
                        $finSoir = $dataheure['finSoir'];
                    }
                } else {
                    $debutMatin = '';
                    $finMatin = '';
                    $debutSoir = '';
                    $finSoir = '';
                }
                ?>
                <div style='display: flex; flex-direction: row; align-items: center; border-bottom: solid 1px black; padding: 2px 0;'>
                    <p style='padding: 0; margin: 0 10px 0 0;'><?php echo date('D', strtotime(date('Y-m-d'). ' - '.$i.' days')); ?></p>
                    <div style='display: flex; flex-direction: column'>
                        <div style='display: flex; flex-direction: row; align-items: center; margin-left: 10px; margin-right: 10px;'>
                            <p style='margin: 0 5px; padding: 0;'>De</p>
                            <input type='time' id='debutMatin<?php echo $date ?>' value='<?php echo $debutMatin ?>'
                            onchange='maj("<?php echo $date ?>")'>
                            <p style='margin: 0 5px; padding: 0;'>a</p>
                            <input type='time' id='finMatin<?php echo $date ?>' value='<?php echo $finMatin ?>'
                            onchange='maj("<?php echo $date ?>")'>
                        </div>
                        <div style='display: flex; flex-direction: row; align-items: center; margin-left: 10px; margin-right: 10px;'>
                            <p style='margin: 0 5px; padding: 0;'>De</p>
                            <input type='time' id='debutSoir<?php echo $date ?>' value='<?php echo $debutSoir ?>'
                            onchange='maj("<?php echo $date ?>")'>
                            <p style='margin: 0 5px; padding: 0;'>a</p>
                            <input type='time' id='finSoir<?php echo $date ?>' value='<?php echo $finSoir ?>'
                            onchange='maj("<?php echo $date ?>")'>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>