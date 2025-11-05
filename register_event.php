<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("Événement introuvable.");
}
$event_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $age = intval($_POST['age']);
    $etat_social = $conn->real_escape_string($_POST['etat_social']);
    $interet = $conn->real_escape_string($_POST['interet']);

    $check = $conn->query("SELECT * FROM registrations WHERE event_id = $event_id AND user_email = '$email'");
    if ($check && $check->num_rows === 0) {
        $conn->query("INSERT INTO registrations (event_id, user_email, nom, prenom, age, etat_social, interet)
                      VALUES ($event_id, '$email', '$nom', '$prenom', $age, '$etat_social', '$interet')");
        $_SESSION['message'] = "✅ Inscription réussie !";
        header("Location: events.php");
        exit();
    } else {
        $message = "⚠️ Vous êtes déjà inscrit à cet événement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription Événement</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">📝 Inscription à l'événement</h2>

  <?php if (!empty($message)): ?>
    <div class="alert alert-warning"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST" class="bg-white shadow p-4 rounded">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Nom</label>
      <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Prénom</label>
      <input type="text" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Âge</label>
      <input type="number" name="age" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Profession</label>
      <input type="text" name="etat_social" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Intérêt pour l'événement</label>
      <textarea name="interet" class="form-control" required></textarea>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">S'inscrire</button>
    </div>
  </form>
</div>

</body>
</html>
