<?php
session_start();
include 'conect_class.php'; // MUY IMPORTANTE.
if (!isset($_COOKIE['inicio'])) {
    // echo '<form method="GET" action ="loginPrueba.php">';
    // echo '<input type="submit" value="Iniciar sesión" name="Inicia-sesión">';
    // echo '</form>';
    setcookie("inicio", 0, time() + 6000, "/");

 }
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

    <form action="index.php" method="post">
        <input type="text" name="user" placeholder="Usuario">
        <br>
        <input type="password" name="password" placeholder="Contraseña">
        <br><br>
        <input type="submit" value="Iniciar sesión" name="btn-ini">
    </form>
    <form action="registro.php" method="post">
        <input type="submit" value="Registrarse" name="btn-gotoreg">
    </form>
   




</body>

</html>
<?php
    //    if (isset($_POST['btn-cerrar-sesion'])) { 
    //     $user = $_POST["user"];
    //     $password = $_POST["password"];
    ?>