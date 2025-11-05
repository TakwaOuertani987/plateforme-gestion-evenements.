<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Plateforme Événements</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Ton style -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include('includes/navbar.php'); ?>

<div class="container mt-5 pt-5">
  <h2 class="text-center mb-5" data-aos="fade-down">🔧 Tableau de Bord Administrateur</h2>

  <!-- Gestion Utilisateurs -->
  <section data-aos="fade-up">
    <h4>Gestion des Utilisateurs</h4>
    <div class="table-responsive">
      <table class="table table-striped table-hover mt-3">
        <thead class="table-dark">
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple de ligne utilisateur -->
          <tr>
            <td>Ahmed Ben Ali</td>
            <td>ahmed@example.com</td>
            <td>Actif</td>
            <td>
              <button class="btn btn-warning btn-sm">Bloquer</button>
              <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
          </tr>
          <tr>
            <td>Sara Mouh</td>
            <td>sara@example.com</td>
            <td>Bloqué</td>
            <td>
              <button class="btn btn-success btn-sm">Débloquer</button>
              <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
          </tr>
          <!-- Ajouter plus de lignes ici -->
        </tbody>
      </table>
    </div>
  </section>

  <!-- Gestion Evénements -->
  <section class="mt-5" data-aos="fade-up">
    <h4>Gestion des Événements</h4>
    <div class="table-responsive">
      <table class="table table-striped table-hover mt-3">
        <thead class="table-dark">
          <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Organisateur</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple de ligne événement -->
          <tr>
            <td>Conférence IA 2025</td>
            <td>2025-05-10</td>
            <td>Ahmed Ben Ali</td>
            <td>En attente</td>
            <td>
              <button class="btn btn-success btn-sm">Valider</button>
              <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
          </tr>
          <tr>
            <td>Webinaire Cybersécurité</td>
            <td>2025-06-15</td>
            <td>Sara Mouh</td>
            <td>Validé</td>
            <td>
              <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
          </tr>
          <!-- Ajouter plus de lignes ici -->
        </tbody>
      </table>
    </div>
  </section>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>
