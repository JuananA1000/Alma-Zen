<?php
include '../conect_class.php'; // MUY IMPORTANTE.
session_start();

//Recoge las variables del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];



$consulta = "SELECT * FROM usuarios WHERE user='$usuario' AND password='$contrasena';";
echo $consulta;
$MyBBDD->consulta($consulta);
$fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

if ($fila == false) { //si el logeo falla
   // echo "Datos incorrectos";
    header("location: login.php"); //Nos lleva a login
 }  else { // si el logeo es exitoso
    $_SESSION['id_empresa'] = $fila['id_empresa'];
    header("location: ../index.php");  //nos lleva al index
     }
