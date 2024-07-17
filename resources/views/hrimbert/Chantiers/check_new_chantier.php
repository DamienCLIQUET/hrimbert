<?php
session_start();
include('../config.php');

$client = $_POST['client'];
$chantier = $_POST['chantier'];
$statut = $_POST['statut'];
$IDChantier = '';

$retour_exist = $base->query("SELECT *
FROM chantier
WHERE client like '%".$client."%'
ORDER BY adresse, telephone, gsm, email, IDChantier");
$adresse = '';
$telephone = '';
$gsm = '';
$email = '';
while ($data_exist = $retour_exist->fetch()){
    if (($data_exist['adresse'] != ''
    OR $data_exist['telephone'] != '' 
    OR $data_exist['gsm'] != ''
    OR $data_exist['email'] != '')
    AND ($data_exist['adresse'] != $adresse
    OR $data_exist['telephone'] != $telephone
    OR $data_exist['gsm'] != $gsm
    OR $data_exist['email'] != $email)) {
        $client = $data_exist['client'];
        $adresse = $data_exist['adresse'];
        $telephone = $data_exist['telephone'];
        $gsm = $data_exist['gsm'];
        $email = $data_exist['email'];
        $IDChantier = $data_exist['IDChantier'];
        ?>
        <div class='connection_button'
        style='margin: 0 10px 10px 10px; font-size: small; display: flex; flex-direction: column; align-items: flex-start;'
        onclick='add_new_chantier("<?php echo $client; ?>", "<?php echo $chantier; ?>", "<?php echo $statut; ?>", "<?php echo $IDChantier; ?>")'>
            <p style='display: flex; flex-direction: row; align-items: flex-start; margin: 2px 0;'>
                <i class='fa-solid fa-user' style='margin-right: 5px;'></i><?php echo $client; ?>
            </p>
            <p style='display: flex; flex-direction: row; align-items: flex-start; margin: 2px 0;'>
                <i class='fa-sharp fa-solid fa-map-location-dot' style='margin-right: 5px;'></i><?php echo $adresse; ?>
            </p>
            <p style='display: flex; flex-direction: row; align-items: flex-start; margin: 2px 0;'>
                <i class='fa-sharp fa-solid fa-phone' style='margin-right: 5px;'></i><?php echo $telephone; ?>
            </p>
            <p style='display: flex; flex-direction: row; align-items: flex-start; margin: 2px 0;'>
                <i class='fa-sharp fa-solid fa-mobile-screen-button' style='margin-right: 5px;'></i><?php echo $gsm; ?>
            </p>
            <p style='display: flex; flex-direction: row; align-items: flex-start; margin: 2px 0;'>
                <i class='fa-sharp fa-solid fa-at' style='margin-right: 5px;'></i><?php echo $email; ?>
            </p>
            <p style='display: flex; flex-direction: row; align-items: center; justify-content: center; width: 100%;'>Choisir ce client</p>
        </div>
        <?php
    }
}