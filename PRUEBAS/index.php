<?php
session_start();
include 'conect_class.php'; // MUY IMPORTANTE.
if (!isset($_COOKIE['inicio'])) {
    // echo '<form method="GET" action ="loginPrueba.php">';
    // echo '<input type="submit" value="Iniciar sesión" name="Inicia-sesión">';
    // echo '</form>';
    setcookie("inicio", 0, time() + 600, "/");

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
<form method="GET" action="loginPrueba.php">
    <input type="submit" value="Iniciar sesión" name="btn-iniciar-sesion">
    </form>
    <form method="GET" action="loginPrueba.php">
    <input type="submit" value="Cerrar sesión" name="btn-cerrar-sesion">
    </form>
</body>
</html>
 <?php

//      --- SI PULSAMOS EL BOTON INICIAR SESION
if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php
 
    $user = $_POST["user"];
    $pass = $_POST["password"];



//      --- COMPROBAMOS QUE EL USUARIO PERTENECE A LA BBDD
    $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$pass';";
    echo $consulta;
    $MyBBDD->consulta($consulta);
    $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

    if ($fila == false) { //si el logeo falla
        echo "Datos incorrectos";
     }  else { // si el logeo es exitoso
        $_COOKIE['inicio'] = $fila['id_user'];
        // $_SESSION['id'] = $fila['id_user'];
        // echo  $_SESSION['estado'];
         echo '<h1>Cookie inicio: '.$_COOKIE['inicio'].'</h1><br>';
         echo 'Sesión iniciada con éxito. Usuario: '.  $fila['user'];
        //  $_SESSION['user'] = $user;
        //  $_SESSION['pass'] = $pass;
        //  echo $_SESSION['user'];

        
     }
}




//  RECIBIMOS LOS DATOS -- DE REGISTRO -- Y LOS METEMOS EN LA BBDD

// if (
//     isset($_POST["btn-reg"])
//     /*&& isset($_POST["password"])
//     && isset($_POST["bio"])
//     && isset($_POST["fech"])
//     && isset($_POST["nacion"])
//     && isset($_POST["term"])
//     NO ES NECESARIO PONER ESTOS ISSET PORQUE AL ESTAR LOS DATOS EN REQUIRED, AL PULSAR EL BOTON YA TIENE LOS DATOS
//     */
// ) {
//     $user = $_POST["user"];
//     $password = $_POST["password"];
//     $bio = $_POST["bio"];
//     $fecha = $_POST["fech"];
//     $nacion = $_POST["nacion"];
//     $sex = $_POST["sex"];

//     //      ---- INSERTAMOS LOS DATOS   ---
//     $inserta = "INSERT INTO entregable4.usuario (nombreUsuario, contrasenna, bio, fechaNacimiento, nacionalidad, sexo) VALUES ('$user','$password','$bio','$fecha','$nacion', '$sex');";
//     echo $inserta;
//     $MyBBDD->consulta($inserta);
//     $_COOKIE['inicio'] = 1;

//      //      ---- SACAMOS LA ID DEL USUARIO   ---
//      $consulta = "SELECT idUSUARIO FROM usuario WHERE nombreUsuario='$user' AND contrasenna='$password';";
//      $MyBBDD->consulta($consulta);
//      $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia
//      $_SESSION['estado'] = $fila['idUSUARIO'];
//      $_SESSION['id'] = $fila['idUSUARIO'];
//      echo  $_SESSION['estado'];
// }