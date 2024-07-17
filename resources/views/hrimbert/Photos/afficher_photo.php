<?php
$id = $_POST['id'];

?>
<i class='fa-solid fa-trash-can fa-xl afficher_photo_delete' title='Supprimer la photo'
onclick='supprimer_photo("<?php echo $id; ?>")'></i>
<div class=' afficher_photo_photo'>
    <img src='<?php echo "../Photos/".$id; ?>'>
</div>
<i class='fa-regular fa-rectangle-xmark fa-xl afficher_photo_close' title='Fermer la photo'
onclick='fermer_photo()'></i>