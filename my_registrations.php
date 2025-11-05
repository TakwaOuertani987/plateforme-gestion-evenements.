<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$email_utilisateur = $_SESSION['email_utilisateur'] ?? null;
if (!$email_utilisateur) {
    header("Location: login.php");
    exit();
}

$registrations = $conn->query("
    SELECT e.titre, e.date_event, e.lieu, r.date_inscription 
    FROM registrations r
    JOIN events e ON r.event_id = e.id
    WHERE r.user_email = '$email_utilisateur'
    ORDER BY r.date_inscription DESC
");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Événements</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-4">🎟️ Mes Inscriptions</h2>

  <?php if ($registrations && $registrations->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Lieu</th>
          <th>Inscrit le</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $registrations->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['titre']) ?></td>
            <td><?= htmlspecialchars($row['date_event']) ?></td>
            <td><?= htmlspecialchars($row['lieu']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['date_inscription'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info text-center">Aucun événement inscrit pour le moment.</div>
  <?php endif; ?>
</div>

</body>
</html>
