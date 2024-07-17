<?php
    $valid_extensions = array('pdf');
    $file = $_FILES['file']['name'];
    $IDChantier = $_POST['IDChantier'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if(in_array($ext, $valid_extensions)) { 
        if (!file_exists($IDChantier)) {
            mkdir($IDChantier, 0777);
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $IDChantier.'/'.$_FILES['file']['name']);
        echo "Fichier ". $_FILES['file']['name']." envoyé avec succès";
    } else {
        echo "Fichier non envoyé";
    }
?>