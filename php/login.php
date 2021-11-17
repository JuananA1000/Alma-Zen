<?php
include 'conect_class.php'; // MUY IMPORTANTE.
// session_start();

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

    <form method="post">
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
        echo $user.'<br>';
        echo $password.'<br>';
       


        $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$password';";
        $MyBBDD->consulta($consulta);
        $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia
echo $consulta;
        if ($fila == false) { //si el logeo falla
            // echo 'MAAAAAAAL '. $user;
            $_SESSION['estado'] = 0;
            echo '<h1>ERROR al iniciar sesión. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
        } else { // si el logeo es exitoso
            echo 'segundaa '. $user;
            $_SESSION['estado'] = $fila['id_user'];
           
            echo '<h1>Sesión iniciada con éxito. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
            // $_SESSION['user'] = $user;
            // $_SESSION['password'] = $password;
            // echo $_SESSION['user'];
            if (!isset($_SESSION['estado'])) { //a estado le asignamos la id del usuario
                $_SESSION['estado'] = $fila['id_user'];
            }
            header('Location: http://localhost/curso/Alma-Zen/php/index.php');
            echo 'PRIMERAA '. $fila['id_user'];
        }
       
       
       
       
    }

    function iniciarSesion($user, $password)
    {
        echo 'segundaa '. $user;
        include 'conect_class.php'; // MUY IMPORTANTE.

        // $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$password';";
        // $MyBBDD->consulta($consulta);
        // $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

        // if ($fila == false) { //si el logeo falla

        //     $_SESSION['estado'] = 0;
        //     echo '<h1>ERROR al iniciar sesión. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
        // } else { // si el logeo es exitoso

        //     $_SESSION['estado'] = $fila['id_user'];
        //     $_SESSION['id'] = $fila['id_user']; // la usaremos más tarde (index.php ejercicio 4 de pablo)

        //     echo '<h1>Sesión iniciada con éxito. Estado:' .  $_SESSION['estado'] . ' </h1><br>';
        //     $_SESSION['user'] = $user;
        //     $_SESSION['password'] = $password;
        //     echo $_SESSION['user'];
        //     if (!isset($_SESSION['estado'])) { //a estado le asignamos la id del usuario
        //         $_SESSION['estado'] = 0;
        //     }
        //     header('Location: http://localhost/curso/Alma-Zen/php/index.php');
        // }
    }

    ?>

    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>



</body>

</html>