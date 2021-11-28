<?php
session_start();
include 'conect_class.php'; // MUY IMPORTANTE.
$id_empresa = $_SESSION["id_empresa"];

if(!isset ($id_empresa)){
    header("location: loginPrueba.php");
}else{
    echo '<h1>BIENVENIDO </h1>';
    echo '<form method="post" action="salir.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form>'; //IMPRIME EL BOTON DE SALIR
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
<!-- <form method="GET" action="loginPrueba.php">
    <input type="submit" value="Iniciar sesión" name="btn-iniciar-sesion">
    </form>
    <form method="GET" action="loginPrueba.php">
    <input type="submit" value="Cerrar sesión" name="btn-cerrar-sesion">
    </form> -->
<!-- Imprimimos el boton de cerrar sesión sesion -->
<!-- <form method="post" action="login.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form> -->

</body>
</html>
 
























<!-- 
//      --- SI PULSAMOS EL BOTON INICIAR SESION
// if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php
 
//     $user = $_POST["user"];
//     $pass = $_POST["password"];



// //      --- COMPROBAMOS QUE EL USUARIO PERTENECE A LA BBDD
//     $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$pass';";
//     echo $consulta;
//     $MyBBDD->consulta($consulta);
//     $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

//     if ($fila == false) { //si el logeo falla
//         echo "Datos incorrectos";
//      }  else { // si el logeo es exitoso
//         $_COOKIE['inicio'] = $fila['id_user'];
//         // $_SESSION['id'] = $fila['id_user'];
//         // echo  $_SESSION['estado'];
//          echo '<h1>Cookie inicio: '.$_COOKIE['inicio'].'</h1><br>';
//          echo 'Sesión iniciada con éxito. Usuario: '.  $fila['user'];
//         //  $_SESSION['user'] = $user;
//         //  $_SESSION['pass'] = $pass;
//         //  echo $_SESSION['user'];

 -->
