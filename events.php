<?php
session_start();

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

// Récupérer les événements validés
$evenements = $conn->query("SELECT * FROM events WHERE statut = 'validé' ORDER BY date_event DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Événements Validés</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-4 fw-bold" data-aos="fade-down">📅 Événements Validés</h2>

  <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-info text-center"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
  <?php endif; ?>

  <div class="row g-4" data-aos="fade-up">
    <?php if ($evenements && $evenements->num_rows > 0): ?>
      <?php while ($event = $evenements->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <img src="<?= !empty($event['image']) ? htmlspecialchars($event['image']) : 'assets/images/default-event.jpg' ?>" 
                 class="card-img-top" alt="Image événement">

            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($event['titre']) ?></h5>
              <p class="card-text text-muted small">
                <?= date('d M Y', strtotime($event['date_event'])) ?> | <?= htmlspecialchars($event['lieu']) ?>
              </p>
              <p class="card-text"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
              
              <?php if (isset($_SESSION['utilisateur_connecte'])): ?>
                <a href="register_event.php?id=<?= $event['id'] ?>" class="btn btn-outline-primary mt-auto">S'inscrire</a>
              <?php else: ?>
                <a href="login.php" class="btn btn-outline-secondary mt-auto">Connectez-vous pour vous inscrire</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">Aucun événement validé pour le moment.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
