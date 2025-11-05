<?php
session_start();
if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['role_utilisateur'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

// 🟢 ACTION : Valider ou Supprimer un événement
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] === 'valider') {
        $conn->query("UPDATE events SET statut = 'validé' WHERE id = $id");
    } elseif ($_GET['action'] === 'supprimer') {
        $conn->query("DELETE FROM events WHERE id = $id");
    }
    // Redirection pour éviter le double traitement lors du rechargement
    header("Location: manage_events.php");
    exit();
}

// Charger les événements
$evenements = $conn->query("SELECT * FROM events ORDER BY date_event DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Événements</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6fa;
    }
    .table-wrapper {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .badge-status {
      font-size: 0.9em;
    }
  </style>
</head>
<body>

<?php include('../includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <div class="table-wrapper" data-aos="fade-up">
    <h2 class="text-center mb-4 fw-bold text-primary">📅 Gestion des Événements</h2>

    <table class="table table-hover table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Lieu</th>
          <th>Catégorie</th>
          <th>Créé par</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($evenements && $evenements->num_rows > 0): ?>
          <?php while ($event = $evenements->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($event['titre']) ?></td>
            <td><?= htmlspecialchars($event['date_event']) ?></td>
            <td><?= htmlspecialchars($event['lieu']) ?></td>
            <td><?= htmlspecialchars($event['categorie']) ?></td>
            <td><?= htmlspecialchars($event['createur_email'] ?? 'Inconnu') ?></td>
            <td>
              <span class="badge bg-<?= $event['statut'] === 'validé' ? 'success' : 'secondary' ?> badge-status">
                <?= ucfirst($event['statut']) ?>
              </span>
            </td>
            <td>
              <div class="btn-group">
                <?php if ($event['statut'] !== 'validé'): ?>
                  <a href="?action=valider&id=<?= $event['id'] ?>" class="btn btn-success btn-sm">Valider</a>
                <?php endif; ?>
                <a href="?action=supprimer&id=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet événement ?')">Supprimer</a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center text-muted">Aucun événement trouvé.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('../includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script src="../assets/js/script.js"></script>
</body>
</html>
