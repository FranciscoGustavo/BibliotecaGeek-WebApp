<main class="col-12 login-container">
  <div class="col-11 col-lg-3 m-auto p-1 login">
    <h1 class="m-1 txt-center">Iniciar sesion</h1>
    <div class="error">
      <?php
        $login = AdminController::login($dashboard);
        if ($login != null) {
          printf($login);
        }
      ?>
    </div>
    <div class="form">
      <form method="post">
        <div class="input-form">
          <input id="loginEmail" type="email" name="loginEmail" placeholder="Correo">
          <label for="loginEmail" ><i class="fas fa-at font-1"></i></label>
        </div>
        <div class="input-form col-12">
          <input id="loginPassword" type="password" name="loginPassword" placeholder="Password">
          <label for="loginPassword" ><i class="fas fa-key"></i></label>
        </div>
        <div class="input-form no-border">
          <input type="submit" name="" value="Entar">
        </div>
      </form>
    </div>
  </div>
</main>
