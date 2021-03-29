<?php

require_once 'app/config.php';

try {
  $db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "",
    DB_USER,
    DB_PASS,
    DB_OPTIONS
  );

  $stmt = $db->prepare('SELECT p.id, p.name, p.slug, p.excerpt, p.status, p.file, u.name AS author FROM posts AS p INNER JOIN users as u ON p.user_id = u.id ORDER BY p.id ASC;');

  $stmt->execute();

  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
}

?>
<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>DataTables Lado Cliente</title>
</head>

<body>
  <header class="container-fluid bg-dark">
    <div class="container px-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0">
        <a class="navbar-brand" href="./">DataTables</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <h1 class="text-center mt-5">DataTables</h1>
    <h3 class="text-center mb-5">Lado Cliente</h3>
    <div class="row">
      <div class="col-12">
        <table id="postsTable" class="table table-striped table-bordered responsive" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th>Autor</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <?php

          foreach ($posts as $key => $value) : ?>

            <tr>
              <td><?= $value["id"] ?></td>
              <td><?= $value["name"] ?></td>
              <td><?= $value["slug"] ?></td>
              <td><button type="button" class="btn btn-block <?= ($value["status"] == 'PUBLISHED') ? 'btn-success' : 'btn-danger' ?>"><?= ($value["status"] == 'PUBLISHED') ? 'PUBLICADO' : 'BORRADOR' ?></button></td>
              <td><?= $value["author"] ?></td>
              <td><img src=" <?= $value["file"] ?>" style="width:100px;"></td>
              <td>
                <div class="btn-group" role="group" aria-label="Action buttons">
                  <button type="button" class="btn btn-primary" data-id="<?= $value['id'] ?>"><i class="far fa-edit text-white"></i></button>
                  <button type="button" class="btn btn-danger deleteBtn" data-id="<?= $value['id'] ?>"><i class="fas fa-trash text-white"></i></button>
                </div>
              </td>
            </tr>

          <?php endforeach ?>

          <tfoot>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th>Autor</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </main>

  <footer class="container-fluid bg-dark text-white py-5 mt-5">
    <div class="row flex-column align-items-center">
      <div class="col-md-6 text-center text-muted mb-5">
        <p class="mb-0">©<?= date('Y') ?> Erick De León. Todos los derechos reservados.</p>
      </div>
      <div class="col-md-6 text-center text-muted">
        <div class="social">
          <a href="https://twitter.com/erickdl_xs" target="_blank" class="twitterColor"><i class="fab fa-twitter"></i></a>
          <a href="https://github.com/erickxs" target="_blank" class="githubColor"><i class="fab fa-github"></i></a>
          <a href="https://www.youtube.com/c/erickdeleondev" target="_blank" class="youtubeColor"><i class="fab fa-youtube"></i></a>
          <a href="https://www.twitch.tv/erickl_s" target="_blank" class="twitchColor"><i class="fab fa-twitch"></i></a>
          <a href="https://account.xbox.com/es-mx/profile?gamertag=ERlCK%20CHINGON" target="_blank" class="xboxColor"><i class="fab fa-xbox"></i></a>
        </div>
      </div>
    </div>
  </footer>


  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="assets/plugins/datatables/datatables.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/js/posts.js"></script>
</body>

</html>