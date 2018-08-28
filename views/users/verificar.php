<?php
  $userChecked = false;
  $value = $rutes[1];
  $item = "encryptedEmail";
  $check = UserController::findUser($item, $value);

  if($check['encryptedEmail'] == $value){
    $id = $check['user_id'];
    $item = "checked";
    $value = 0;
    $res = UserController::updateUser($id, $item, $value);
    if ($res == "OK") {
      $userChecked = true;
    }
  }

?>

<div class="container">
  <div class="checked flex flex-column jc-center">
    <?php if($userChecked){ ?>
      <div class="title-check p-1">
        <h1 class="font-5">¡Genial!</h1>
      </div>
      <div class="description-check p-1">
        <p>Tu cuenta registrada con el correo <?php printf($check['email']); ?> ah sido validada, ya puedes iniciar session.</p>
      </div>
      <div class="button-check p-1">
        <button onclick="login();">Iniciar Sesion</button>
      </div>

    <?php } else { ?>
      <div class="title-check p-1">
        <h1 class="font-5">¡Upss...!</h1>
      </div>

      <div class="description-check p-1">
        <p>Tu cuenta no a podido ser validada.</p>
      </div>

      <div class="button-check p-1">
        <button onclick="logup();">Registrarme</button>
      </div>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">
  function login(){
    document.querySelector(".login").click();
  }

  function logup(){
    document.querySelector(".logup").click();
  }
</script>
