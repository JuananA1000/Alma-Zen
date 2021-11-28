<?php
session_start();
include '../conect_class.php'; // MUY IMPORTANTE.
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- RECOGEMOS LOS DATOS PARA INICIAR SESION  -->

    <form action="logear.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario">
        <br>
        <input type="password" name="contrasena" placeholder="Contraseña">
        <br><br>
        <input type="submit" value="Iniciar sesión" name="btn-ini">
    </form>
 
</body>

</html>
<?php

    ?>