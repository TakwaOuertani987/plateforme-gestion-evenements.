<?php
session_start();

// Autorisation uniquement pour l’admin connecté
if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['role_utilisateur'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Connexion à la base
$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die('Erreur connexion MySQL : ' . $conn->connect_error);
}

// Actions sur les utilisateurs
if (isset($_GET['action'], $_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] === 'bloquer') {
        $conn->query("UPDATE users SET statut = 'bloqué' WHERE id = $id");
    } elseif ($_GET['action'] === 'debloquer') {
        $conn->query("UPDATE users SET statut = 'actif' WHERE id = $id");
    } elseif ($_GET['action'] === 'supprimer') {
        $conn->query("DELETE FROM users WHERE id = $id");
    }
    header("Location: manage_users.php");
    exit();
}

// Récupère uniquement les utilisateurs inscrits (rôle = utilisateur)
$utilisateurs = $conn->query("SELECT * FROM users WHERE role = 'utilisateur'");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Utilisateurs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
    }
    .table-wrapper {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<?php include('../includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <div class="table-wrapper" data-aos="fade-up">
    <h2 class="text-center mb-4 fw-bold text-primary">👤 Utilisateurs inscrits</h2>

    <table class="table table-hover table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($utilisateurs->num_rows > 0): ?>
          <?php while ($user = $utilisateurs->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($user['nom_complet']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
              <span class="badge bg-<?= $user['statut'] === 'actif' ? 'success' : 'danger' ?>">
                <?= ucfirst($user['statut']) ?>
              </span>
            </td>
            <td>
              <div class="btn-group">
                <?php if ($user['statut'] === 'actif'): ?>
                  <a href="?action=bloquer&id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Bloquer</a>
                <?php else: ?>
                  <a href="?action=debloquer&id=<?= $user['id'] ?>" class="btn btn-success btn-sm">Débloquer</a>
                <?php endif; ?>
                <a href="?action=supprimer&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center text-muted">Aucun utilisateur inscrit trouvé.</td></tr>
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
