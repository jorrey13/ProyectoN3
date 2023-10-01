<?php
session_start();
session_cache_expire();
session_destroy();
header("Location: /index.php?cierre_de_sesion");

?>