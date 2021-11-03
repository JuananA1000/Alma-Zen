<?php
session_start();
if (!isset($_SESSION['estado'])) { //creamos la variable sesion que usaremos para ver si estamos logeados
    $_SESSION['estado'] = 0;
}
// estado = 0 -> sin logear
// estado = 1 O DISTINTO DE 0 ->  logeado

include 'conect_class.php'; // MUY IMPORTANTE.


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Inicio</title>
</head>
<!-- Imprimimos el boton Iniciar sesion -->
<form method="post" action="login.php">
    <input type="submit" value="Iniciar Sesión" name="inicia-sesion">
</form>

<body>
    <h1>ALMA-ZEN</h1>

    <p>Inicio Sesión</p>
    <!-- 
        TUTORIAL inicio sesión: https://www.youtube.com/watch?v=9BLoMGO-XcU
        TUTORIAL roles: https://www.youtube.com/watch?v=LL66QTP3txE
    -->

    <?php

    //      --- SI PULSAMOS EL BOTON INICIAR SESION
    if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php

        $user = $_POST["user"];
        $password = $_POST["password"];



        //      --- COMPROBAMOS QUE EL USUARIO PERTENECE A LA BBDD
        $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$password';";
        $MyBBDD->consulta($consulta);
        $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

        if ($fila == false) { //si el logeo falla
            echo '<h1>ERROR al iniciar sesión. Estado:' .  $_SESSION['estado']. ' </h1><br>';
        } else { // si el logeo es exitoso
            $_SESSION['estado'] = $fila['id_user'];
            $_SESSION['id'] = $fila['id_user']; // la usaremos más tarde (index.php ejercicio 4 de pablo)

            echo '<h1>Sesión iniciada con éxito. Estado:' .  $_SESSION['estado']. ' </h1><br>';
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            echo $_SESSION['user'];

            //AÚN ESTÁ PENDIENTE DE PROBARLO. HAY QUE INSERTAR DATOS EN LA BBDD

            //TAMBIÉN FALTA HACER LA PARTE DEL REGISTRO. PERO ANTES HAY QUE TOCAR LA TABLA USUARIOS DE LA BBDD

        }
    }

    //  RECIBIMOS LOS DATOS -- DE REGISTRO -- Y LOS METEMOS EN LA BBDD
if (
    isset($_POST["btn-reg"])
) {
    $empresa = $_POST["empresa"];
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];


    //      ---- INSERTAMOS LOS DATOS   ---
    $inserta = "INSERT INTO usuarios (id_empresa, user, email, password, rol) VALUES ('$empresa', '$user','$email','$password', '$rol');";
    echo $inserta;
    $MyBBDD->consulta($inserta);
   // $_COOKIE['inicio'] = 1; Esta cookie juraría que no hace nada, pero la dejo de momento porsiaca

     //      ---- SACAMOS LA ID DEL USUARIO   ---
     // ------------ ESTO NOS SERVIRÁ PARA NAVEGAR POR LA PÁGINA REGISTRADOS
     $consulta = "SELECT id_user FROM usuarios WHERE user='$user' AND password='$password';";
     $MyBBDD->consulta($consulta);
     $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia
     $_SESSION['estado'] = $fila['id_user'];
     $_SESSION['id'] = $fila['id_user'];
     echo   '<br><h1>Registrados con id nº '.$_SESSION['estado'].'</h1><br>';
}






    if (isset($_POST['nombre_empresa'])) {
        $nombre_empresa = $_POST['nombre_empresa'];
        $sql = "INSERT INTO empresas (nombre_empresa) VALUES ('$nombre_empresa');";
        $MyBBDD->consulta($sql);
    }

    $sql = "SELECT * FROM empresas;";
    $MyBBDD->consulta($sql);

    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_empresa = $fila['id_empresa']; // id_empresa de la empresa
        echo "Empresa: <a href='empresas.php?id_empresa=$id_empresa'>" . $fila['nombre_empresa'] . "</a><br>";
    }
    ?>

    <form method="POST">
        <p>Nombre Empresa: <input type="text" name="nombre_empresa" />
            <input type="submit" value="Insertar">
        </p>
    </form>

    <footer>Juan Antonio Amil y Antonio Marín</footer>


</body>

</html>