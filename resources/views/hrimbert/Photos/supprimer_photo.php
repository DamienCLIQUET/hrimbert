<?php
    $photo = str_replace('%20', ' ', $_POST['id']);
    unlink($photo);
?>