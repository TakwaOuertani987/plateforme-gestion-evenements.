<?php
// Ce fichier sera utilisé pour détruire la session et rediriger l'utilisateur.

session_start();
session_unset();
session_destroy();

header('Location: index.php');
exit;
?>
