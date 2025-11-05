<?php
session_start();

// Vérification d’accès admin
if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['role_utilisateur'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Tableau de bord</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include('../includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-5 fw-bold" data-aos="fade-down">Tableau de Bord Administrateur</h2>

  <div class="row justify-content-center g-4" data-aos="fade-up">
    <!-- Gestion des utilisateurs -->
    <div class="col-md-5">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <img src="../assets/images/gestion des utlisateurs.png" alt="Gérer utilisateurs" style="height: 80px;" class="mb-3">
          <h5 class="card-title fw-bold">Gérer les Utilisateurs</h5>
          <p class="card-text">Bloquer, débloquer ou supprimer les comptes utilisateurs.</p>
          <a href="manage_users.php" class="btn btn-warning mt-2">Gérer Utilisateurs</a>
        </div>
      </div>
    </div>

    <!-- Gestion des événements -->
    <div class="col-md-5">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <img src="../assets/images/gestion des événement.png" alt="Gérer événements" style="height: 80px;" class="mb-3">
          <h5 class="card-title fw-bold">Gérer les Événements</h5>
          <p class="card-text">Modérer, valider ou supprimer les événements proposés.</p>
          <a href="manage_events.php" class="btn btn-success mt-2">Gérer Événements</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../includes/footer.php'); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script src="../assets/js/script.js"></script>

</body>
</html>
