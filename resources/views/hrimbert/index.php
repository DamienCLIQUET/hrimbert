<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <title>Hervé RIMBERT</title>
		<link rel ="stylesheet" href="css/HRimbert.css" />
		<link rel ="stylesheet" href="css/HRimbert-tab.css" />
		<link rel ="stylesheet" href="css/HRimbert-gsm.css" />
		<link rel="icon" href="Images/Icone.png"/>
        <script src="https://kit.fontawesome.com/0b84318fd8.js" crossorigin="anonymous"></script>
    </head>
    <?php
    session_start();
    include('config.php');

    if (!empty($_GET['trier'])){
        $trier = $_GET['trier'];
    } else {
        $trier = 'alpha';
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='index.js'></script>
    <body onLoad='liste_chantier("<?php echo $trier; ?>")'>
        <div id='corps' class='corps'>

        </div>
        <div id='chargement' class='chargement'>
            <img src='Images/Chargement.gif'>
        </div>
    </body>
</html>