<?php
session_start();

// Vérification utilisateur connecté
if (!isset($_SESSION['utilisateur_connecte'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon Tableau de Bord</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-5 fw-bold" data-aos="fade-down">Mon Tableau de Bord</h2>

  <div class="row justify-content-center g-4" data-aos="fade-up">
    <!-- Carte : Créer un Événement -->
    <div class="col-md-4">
      <div class="card shadow h-100 border-0">
        <div class="card-body text-center">
          <img src="assets/images/evenement7.png" alt="Créer événement" style="height: 200px;" class="mb-3">
          <h5 class="card-title fw-bold">Créer un Événement</h5>
          <p class="card-text">Organisez vos propres conférences, webinaires et ateliers en quelques clics.</p>
          <a href="create_event.php" class="btn btn-primary mt-2">Créer</a>
        </div>
      </div>
    </div>

    <!-- Carte : Voir les Événements -->
    <div class="col-md-4">
      <div class="card shadow h-100 border-0">
        <div class="card-body text-center">
          <img src="assets/images/evenement2.png" alt="Voir événements" style="height: 200px;" class="mb-3">
          <h5 class="card-title fw-bold">Voir les Événements</h5>
          <p class="card-text">Découvrez les événements disponibles, filtrez par date, lieu ou catégorie.</p>
          <a href="events.php" class="btn btn-success mt-2">Explorer</a>
        </div>
      </div>
    </div>

    <!-- Carte : Mes Inscriptions -->
    <div class="col-md-4">
      <div class="card shadow h-100 border-0">
        <div class="card-body text-center">
          <img src="assets/images/evenement5.png" alt="Mes inscriptions" style="height: 200px;" class="mb-3">
          <h5 class="card-title fw-bold">Mes Inscriptions</h5>
          <p class="card-text">Consultez facilement tous les événements auxquels vous êtes inscrit(e).</p>
          <a href="my_registrations.php" class="btn btn-warning mt-2">Voir mes inscriptions</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="assets/js/script.js"></script>

</body>
</html>
