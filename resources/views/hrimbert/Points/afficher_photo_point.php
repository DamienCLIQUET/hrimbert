<?php
$id = $_POST['id'];
$IDPoint = $_POST['IDPoint'];

?>
<i class='fa-solid fa-trash-can fa-xl afficher_photo_delete' title='Supprimer la photo'
onclick='supprimer_photo_point("<?php echo $id; ?>", "<?php echo $IDPoint; ?>")'></i>
<div class=' afficher_photo_photo'>
    <img src='<?php echo "../Points/".$id; ?>'>
</div>
<i class='fa-regular fa-rectangle-xmark fa-xl afficher_photo_close' title='Fermer la photo'
onclick='fermer_photo()'></i>