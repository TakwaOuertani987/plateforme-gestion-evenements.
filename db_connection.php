<?php
// db_connection.php

// Paramètres de connexion à la base de données
$servername = "localhost";  // Nom du serveur, généralement "localhost" en local
$username = "root";         // Nom d'utilisateur, généralement "root" pour XAMPP
$password = "";             // Mot de passe, vide pour XAMPP par défaut
$dbname = "plateforme_evenements";  // Nom de ta base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    // Si la connexion échoue, afficher une erreur et arrêter le script
    die("Échec de la connexion : " . $conn->connect_error);
} 
?>
