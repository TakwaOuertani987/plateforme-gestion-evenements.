<?php
session_start();

// Connexion à la base
$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');

if ($conn->connect_error) {
    die('Erreur connexion MySQL : ' . $conn->connect_error);
}

// Traitement du formulaire
if (!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($user['statut'] === 'bloqué') {
            $erreur = "⛔ Votre compte est bloqué.";
        } else {
            $_SESSION['utilisateur_connecte'] = true;
            $_SESSION['id_utilisateur'] = $user['id'];
            $_SESSION['nom_utilisateur'] = $user['nom_complet'];
            $_SESSION['email_utilisateur'] = $user['email']; // ✅ Nouvelle ligne
            $_SESSION['role_utilisateur'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin/admin_dashboard.php');
            } else {
                header('Location: dashboard.php');
            }
            exit();
        }
    } else {
        $erreur = "❌ Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-4 fw-bold" data-aos="fade-down">Connexion</h2>

  <?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger text-center"><?php echo $erreur; ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php" class="col-md-6 offset-md-3 p-4 shadow rounded bg-white" data-aos="fade-up">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Mot de passe</label>
      <input type="password" name="mot_de_passe" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success btn-lg">Connexion</button>
    </div>

    <p class="mt-3 text-center">Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
  </form>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script src="assets/js/script.js"></script>
</body>
</html>
