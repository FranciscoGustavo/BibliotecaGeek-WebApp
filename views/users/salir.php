<?php
  session_destroy();

  if (!empty($_SESSION['id_token_google'])) {
    unset($_SESSION['id_token_google']);
  }

  printf('<script type="text/javascript">
    window.location = "'.$home.'"
  </script>');
