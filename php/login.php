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
    <form action="register.php" method="post">
        <input type="submit" value="Registrarse" name="btn-gotoreg">
    </form>
    <?php
    if (isset($error)) {
        echo '<br>' . $error;
    };
    ?>




</body>

</html>