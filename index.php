<?php
// Simulation pour l'affichage (à remplacer plus tard par la session PHP)
$type_utilisateur = "visiteur"; // "utilisateur" ou "admin" selon le cas
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Titre de la page</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

  <!-- AOS Animation CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Ton fichier de style personnalisé -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>

<?php include('includes/navbar.php'); ?>

<!-- HERO SECTION -->
<header class="hero-section d-flex align-items-center text-center text-white" style="background: url('https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover; height: 100vh;">

  <div class="container" data-aos="fade-down">
    <h1 class="display-4 fw-bold">Organisez. Participez. Brillez ✨</h1>
    <p class="lead mt-3">La meilleure plateforme pour vos conférences, webinaires et ateliers.</p>

    <?php if ($type_utilisateur === "admin"): ?>
      <a href="admin/admin_dashboard.php" class="btn btn-warning btn-lg mt-4">Accéder au Tableau Admin</a>
    <?php elseif ($type_utilisateur === "utilisateur"): ?>
      <a href="dashboard.php" class="btn btn-primary btn-lg mt-4">Mon Espace Personnel</a>
    <?php else: ?>
      <a href="register.php" class="btn btn-success btn-lg mt-4">Commencer Maintenant</a>
    <?php endif; ?>
  </div>
</header>

<!-- ABOUT SECTION -->
<section class="py-5" data-aos="fade-up">
  <div class="container">
    <h2 class="text-center mb-4 fw-bold">Pourquoi choisir notre plateforme ?</h2>
    <div class="row text-center">
      <div class="col-md-4 mb-4">
        <img src="assets/images/easy.png" alt="Facilité" class="about-icon mb-3" style="height: 80px;">
        <h5>Facilité</h5>
        <p>Créer ou trouver un événement devient un jeu d'enfant.</p>
      </div>

      <div class="col-md-4 mb-4">
        <img src="assets/images/global.png" alt="Accessibilité" class="about-icon mb-3" style="height: 80px;">
        <h5>Accessibilité</h5>
        <p>Accédez à vos événements où que vous soyez, sur tous vos appareils.</p>
      </div>

      <div class="col-md-4 mb-4">
        <img src="assets/images/security.png" alt="Sécurité" class="about-icon mb-3" style="height: 80px;">
        <h5>Sécurité</h5>
        <p>La protection de vos données est notre priorité absolue.</p>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<!-- Scripts -->
<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Ton script personnel -->
<script src="assets/js/script.js"></script>



</body>
</html>
