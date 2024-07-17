<?php
session_start();
date_default_timezone_set('Europe/Paris');
include('../config.php');

if ($_SESSION["VoirActionhr"] == '1') {
$IDChantier = $_POST['IDChantier'];
?>
<div class='actions_ajout'>
    <div style='display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    margin: 2px;'
    title='Ajouter une action'
    onclick='new_action(<?php echo $IDChantier; ?>)'>
        <i class='fa-solid fa-calendar-days fa-2xl'></i>
        <i class='fa-solid fa-circle picto_fond'></i>
        <i class='fa-regular fa-circle picto_cercle'></i>
        <i class='fa-solid fa-plus fa-2xs picto_plus_action'></i>
    </div>
</div>
<div class='actions_actions'>
<?php
    $retouraction = $base->query("SELECT type, date, commentaire, createur
    FROM actions
    WHERE IDChantier = '".$IDChantier."' ORDER BY date DESC");
    while ($dataaction = $retouraction->fetch()){
        $type = $dataaction['type'];
        $date = date('d/m/Y', strtotime($dataaction['date']));
        $heure = date('H:i', strtotime($dataaction['date']));
        $commentaire = htmlspecialchars($dataaction['commentaire'], ENT_QUOTES);
        $createur = $dataaction['createur'];
        ?>
        <div class='actions_actions_action'>
            <p class='actions_actions_action_date' title='<?php echo $heure; ?>'><?php echo $date; ?></p>
            <p class='actions_actions_action_type'><?php echo $type; ?></p>
            <p class='actions_actions_action_commentaire'><?php echo $commentaire; ?></p>
            <p class='actions_actions_action_user'><?php echo $createur; ?></p>
        </div>
        <?php
    }
    ?>
</div>
<?php
}
?>