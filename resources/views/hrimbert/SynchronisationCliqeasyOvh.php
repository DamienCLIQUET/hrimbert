<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Mise à jour tables etsrimbert</title>
    </head>
    <body>
        <?php
            $userovh = 'cliqeaidamien';
            $passovh = 'DzzGorion123';
            try {
                $base = new PDO('mysql:host=cliqeaidamien.mysql.db; dbname=cliqeaidamien', $userovh, $passovh);
            }
            catch(exception $e) {
                die('Erreur '.$e->getMessage());
            }
            $base->exec("SET CHARACTER SET utf8");
                        
            $jsonData = file_get_contents("http://37.143.52.185:6850/HRimbert/SynchroCliqeasyOvh.php");
            if (strlen($jsonData) > 0) {
                $tableau = json_decode($jsonData, true);
            }
            // echo "<pre>";
            // print_r($tableau);
            // echo "</pre>";
            foreach ($tableau as &$value) {
                // echo $value[0];
                // echo"<br>";
                $trucate_table = $base->query("TRUNCATE ".$value[0]);
                $insert = "INSERT INTO ".$value[0]." (";
                foreach ($value[1] as &$titre) {
                    // echo $titre." / ";
                    $insert = $insert.$titre.", ";
                }
                $insert = substr($insert, 0, -2).") VALUES ( ";
                foreach ($value[2] as &$datas) {
                    // echo "<br>";
                    $set = "";
                    foreach ($datas as &$data) {
                        // echo $data." / ";
                        if ($data ==''){
                            $set = $set."null, ";
                        } else {
                            $set = $set."'".str_replace('\'', '\\\'', $data)."', ";
                        }
                    }
                    $requete = $insert.substr($set, 0, -2).")";
                    echo "<br>".$requete;
                    $retour_requete = $base->query($requete);
                }
                echo "<br>";
            }
        ?>
    </body>
</html>