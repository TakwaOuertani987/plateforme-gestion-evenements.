<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$conn = new mysqli("localhost", "root", "", "plateforme_evenements");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $email = $conn->real_escape_string($_POST['email']);
    $mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);
    $role = "utilisateur";
    $statut = "actif";

    $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check && $check->num_rows > 0) {
        $erreur = "❌ Un compte avec cet email existe déjà.";
    } else {
        $insert = $conn->query("INSERT INTO users (nom_complet, email, mot_de_passe, role, statut)
                                VALUES ('$nom', '$email', '$mot_de_passe', '$role', '$statut')");
        if ($insert) {
            $_SESSION['utilisateur_connecte'] = true;
            $_SESSION['nom_utilisateur'] = $nom;
            $_SESSION['email_utilisateur'] = $email;
            $_SESSION['role_utilisateur'] = $role;
            header("Location: dashboard.php");
            exit();
        } else {
            $erreur = "Erreur SQL : " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un Compte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap + Google Fonts + AOS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f4f8;
    }
    .form-container {
      background: #ffffff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-4 fw-bold" data-aos="fade-down">Créer un Compte</h2>

  <?php if (!empty($erreur)): ?>
    <div class="alert alert-danger text-center" data-aos="fade-up"><?= $erreur ?></div>
  <?php endif; ?>

  <form action="register.php" method="POST" class="col-md-6 offset-md-3 form-container" data-aos="fade-up">
    <div class="mb-3">
      <label class="form-label">Nom complet</label>
      <input type="text" name="nom" class="form-control" required placeholder="Ex: Ahmed Ben Ali">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required placeholder="Ex: ahmed@example.com">
    </div>
    <div class="mb-3">
      <label class="form-label">Mot de passe</label>
      <input type="password" name="mot_de_passe" class="form-control" required placeholder="********">
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary btn-lg">Créer mon compte</button>
    </div>
    <p class="mt-3 text-center">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
  </form>
</div>

<?php include('includes/footer.php'); ?>

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
