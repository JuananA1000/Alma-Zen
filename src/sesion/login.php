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
   <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
    <div id="todo" >
        <h1>ALMA-ZEN</h1>
        <form action="logear.php" method="post" class="cuadrado">
          
                <h3>Inicio de Sesión</h3>
        <div>
                
                <input  class="campo" type="text" name="usuario" placeholder="Usuario">
            </div>
            <div>
              
                <input class="campo" type="password" name="contrasena" placeholder="Contraseña">
            </div>
            <input id="btn-iniciar-sesion" type="submit" value="Iniciar sesión" name="btn-ini">
            
        </form>
    </div>

    
    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>
</body>

</html>