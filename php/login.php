<?php
include 'conect_class.php'; // MUY IMPORTANTE.
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

    <form  method="post">
        <input type="text" name="user" placeholder="Usuario">
        <br>
        <input type="password" name="password" placeholder="Contraseña">
        <br><br>
        <input type="submit" value="Iniciar sesión" name="btn-ini">
    </form>
    <form action="register.php" method="post">
        <input type="submit" value="Registrarse" name="btn-gotoreg">
    </form>
    <?php
    if (isset($error)) {
        echo '<br>' . $error;
    }



    if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php

        $user = $_POST["user"];
        $password = $_POST["password"];

 $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$password';";
    $MyBBDD->consulta($consulta);
    $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

    if ($fila == false) { //si el logeo falla
        $_SESSION['estado'] = 0;
        echo ' action="index.php"';
       
        echo '<h1>ERROR al iniciar sesión. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
    } else { // si el logeo es exitoso
        $_SESSION['estado'] = $fila['id_user'];
        $_SESSION['id'] = $fila['id_user']; // la usaremos más tarde (index.php ejercicio 4 de pablo)

        echo '<h1>Sesión iniciada con éxito. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        echo $_SESSION['user'];
        header ('Location: http://localhost/curso/Alma-Zen/php/index.php');
    }
}
    ?>

    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>



</body>

</html>