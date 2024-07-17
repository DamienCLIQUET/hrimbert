<?php
    $valid_extensions = array('png','jpg','jpeg','gif');
    $file = $_FILES['file']['name'];
    $IDPoint = $_POST['IDPoint'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if(in_array($ext, $valid_extensions)) { 
        if (!file_exists($IDPoint)) {
            mkdir($IDPoint, 0777);
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $IDPoint.'/'.$_FILES['file']['name']);
        echo "Fichier ". $_FILES['file']['name']." envoyé avec succès";
    } else {
        echo "Fichier non envoyé";
    }
?>