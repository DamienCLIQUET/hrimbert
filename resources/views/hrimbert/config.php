<?php
// $user = "ets.rimbert";
// $pass = "7192poule";
// try {
//     $base_free = new PDO('mysql:host=sql.free.fr; dbname=ets.rimbert', $user, $pass);
// }
// catch(exception $e) {
//     die('Erreur '.$e->getMessage());
// }
// $base->exec("SET CHARACTER SET utf8");

$user = "DCLIQUET";
$pass = "DAMIEN76";
try {
    $base = new PDO('mysql:host=localhost; dbname=etsrimbert', $user, $pass);
}
catch(exception $e) {
    die('Erreur '.$e->getMessage());
}
$base->exec("SET CHARACTER SET utf8");

// try {
//     $base_hrimbert = new PDO('mysql:host=localhost; dbname=hrimbert', $user, $pass);
// }
// catch(exception $e) {
//     die('Erreur '.$e->getMessage());
// }
// $base_hrimbert->exec("SET CHARACTER SET utf8");

try {
    $base_electrik = new PDO('mysql:host=localhost; dbname=electrik', $user, $pass);
}
catch(exception $e) {
    die('Erreur '.$e->getMessage());
}
$base_electrik->exec("SET CHARACTER SET utf8");

// $userovh = 'cliqeaidamien';
// $passovh = 'DzzGorion123';
// try {
//     $base = new PDO('mysql:host=cliqeaidamien.mysql.db; dbname=cliqeaidamien', $userovh, $passovh);
// }
// catch(exception $e) {
//     die('Erreur '.$e->getMessage());
// }
// $base->exec("SET CHARACTER SET utf8");
?>