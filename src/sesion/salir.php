<?php
session_start();
session_destroy(); //destruye toda la información asociada con la sesión actual

header("location: login.php");
exit();
?>