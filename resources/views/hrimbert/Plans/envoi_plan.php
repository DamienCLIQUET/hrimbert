<?php
    $valid_extensions = array('png','jpg','jpeg','gif');
    $file = $_FILES['file']['name'];
    $IDChantier = $_POST['IDChantier'];
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $nom_fichier = 1;
    if(in_array($ext, $valid_extensions)) { 
        if (!file_exists($IDChantier)) {
            mkdir($IDChantier, 0777);
        } else {
            $scandir = scandir($IDChantier."/");
            foreach($scandir as $fichier){
                if (substr($fichier, 0, 1) != '.'
                AND (pathinfo($fichier, PATHINFO_EXTENSION) == "jpg"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "png"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "PNG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "jpeg"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "JPEG"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "gif"
                OR pathinfo($fichier, PATHINFO_EXTENSION) == "GIF")){
                    if ($nom_fichier < basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION))){
                        $nom_fichier = basename($fichier,".".pathinfo($fichier, PATHINFO_EXTENSION));
                    }
                }
            }
            $nom_fichier++;
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $IDChantier.'/'.$nom_fichier.'.'.pathinfo($file, PATHINFO_EXTENSION));
        echo "Fichier ". $_FILES['file']['name']." envoyé avec succès";
    } else {
        echo "Fichier non envoyé";
    }
?>