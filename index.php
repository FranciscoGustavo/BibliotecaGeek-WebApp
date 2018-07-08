<!DOCTYPE html>
<html lang="es-mx">
  <head>
    <?php require_once 'views/helpers/head.php'  ?>
  </head>
  <body>
    <?php require_once 'views/helpers/header.php';  ?>

    <main class="container-fluid">
      <?php require_once 'views/main/relative-header.php'; ?>
      <section class="container">
        <?php  require_once 'views/main/slider.php' ?>
        <?php require_once 'views/main/posts.php' ?>
      </section>
      <?php require_once 'views/helpers/footer.php'; ?>
    </main>

    <script src="assets/js/main.js"> </script>

  </body>
</html>
