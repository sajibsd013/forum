<?php
session_start();
echo "Logging you out , plaese wait...";
session_destroy();

header("Location: /forum/index.php");

?>