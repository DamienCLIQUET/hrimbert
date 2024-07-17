<?php
$user = "DCLIQUET";
$pass = "DAMIEN76";
try {
    $base = new PDO('mysql:host=localhost; dbname=etsrimbert', $user, $pass);
}
catch(exception $e) {
    die('Erreur '.$e->getMessage());
}
$base->exec("SET CHARACTER SET utf8");

$retourNAME = $base->query("SELECT * FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'etsrimbert'");
$tableau = [];
while ($dataNAME = $retourNAME->fetch()){
    $table = [];
    array_push($table, $dataNAME['TABLE_NAME']);
    $titre = [];
    $nb = 0;
    $retourCOLUMN = $base->query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'etsrimbert' AND TABLE_NAME = '".$dataNAME['TABLE_NAME']."'");
    while ($dataCOLUMN = $retourCOLUMN->fetch()){
        $nb++;
        array_push($titre, $dataCOLUMN['COLUMN_NAME']);
    }
    array_push($table, $titre);
    $datas = [];
    $retourCONTENU = $base->query("SELECT * FROM ".$dataNAME['TABLE_NAME']."");
    while ($dataCONTENU = $retourCONTENU->fetch()){
        $data = [];
        for ($i = 0; $i < $nb; $i++) {
            array_push($data, $dataCONTENU[$i]);
        }
        array_push($datas, $data);
    }
    array_push($table, $datas);
    array_push($tableau, $table);
}
echo json_encode($tableau);
?>