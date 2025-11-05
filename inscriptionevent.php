<?php
session_start();
if (!isset($_SESSION['utilisateur_connecte'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
if ($event_id <= 0) {
    die("ID d'événement invalide.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    $age = intval($_POST['age']);
    $etat = $conn->real_escape_string($_POST['etat_social']);
    $interet = $conn->real_escape_string($_POST['interet']);
    $user_id = $_SESSION['id_utilisateur'];

    $conn->query("INSERT INTO registrations (user_id, event_id, nom, prenom, email, age, etat_social, interet)
                  VALUES ($user_id, $event_id, '$nom', '$prenom', '$email', $age, '$etat', '$interet')");

    header('Location: my_registrations.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription Événement</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Inscription à l'événement</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Nom</label>
      <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Prénom</label>
      <input type="text" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Âge</label>
      <input type="number" name="age" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>État social</label>
      <input type="text" name="etat_social" class="form-control">
    </div>
    <div class="mb-3">
      <label>Pourquoi vous êtes intéressé ?</label>
      <textarea name="interet" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Valider l'inscription</button>
  </form>
</div>
</body>
</html>
