<?php
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_connecte'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'plateforme_evenements');

if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['date_event']) && !empty($_POST['lieu']) && !empty($_POST['categorie']) && isset($_FILES['image'])) {
    $titre = $conn->real_escape_string($_POST['titre']);
    $description = $conn->real_escape_string($_POST['description']);
    $date_event = $conn->real_escape_string($_POST['date_event']);
    $lieu = $conn->real_escape_string($_POST['lieu']);
    $categorie = $conn->real_escape_string($_POST['categorie']);
    $statut = 'en_attente';
    $createur_email = $_SESSION['email_utilisateur'];

    // 🔁 Gestion du fichier image
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "assets/images/events/" . uniqid() . "_" . basename($image_name);

    if (move_uploaded_file($image_tmp, $image_path)) {
        // Enregistrement avec l'image
        $image_sql = $conn->real_escape_string($image_path);
        $conn->query("INSERT INTO events (titre, description, date_event, lieu, categorie, statut, createur_email, image) 
                      VALUES ('$titre', '$description', '$date_event', '$lieu', '$categorie', '$statut', '$createur_email', '$image_sql')");
        $success = "✅ Événement créé avec image !";
    } else {
        $erreur = "❌ Échec de l'envoi de l'image.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un Événement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-4 fw-bold" data-aos="fade-down">Créer un Nouvel Événement</h2>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success text-center"><?= $success ?></div>
  <?php elseif (!empty($erreur)): ?>
    <div class="alert alert-danger text-center"><?= $erreur ?></div>
  <?php endif; ?>

  <form action="create_event.php" method="POST" enctype="multipart/form-data" class="col-md-8 offset-md-2 p-4 shadow rounded bg-white" data-aos="fade-up">
    <div class="mb-3">
      <label class="form-label">Titre</label>
      <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" name="date_event" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Lieu</label>
      <input type="text" name="lieu" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Catégorie</label>
      <select name="categorie" class="form-select" required>
        <option value="">-- Choisissez une catégorie --</option>
        <option value="Conférence">Conférence</option>
        <option value="Webinaire">Webinaire</option>
        <option value="Atelier">Atelier</option>
        <option value="Formation">Formation</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Image (illustration)</label>
      <input type="file" name="image" accept="image/*" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary btn-lg">Publier</button>
    </div>
  </form>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
