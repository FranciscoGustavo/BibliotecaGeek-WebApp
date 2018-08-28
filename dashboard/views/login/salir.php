<?php
  session_destroy();

  printf('<script type="text/javascript">
    window.location = "'.$dashboard.'"
  </script>');
