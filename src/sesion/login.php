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
   <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>

<body>
    <div id="divForm" >
        <h1>ALMA-ZEN</h1>
        <form action="logear.php" method="post" class="contenidoFormulario">
            <fieldset>
                <legend>Inicio de Sesión</legend>
        <div>
                <label>Usuario</label><br>
                <input type="text" name="usuario" placeholder="Usuario">
            </div>
            <div>
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>
            <input type="submit" value="Iniciar sesión" name="btn-ini">
            </fieldset>
        </form>
    </div>

    
    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>
</body>

</html>