<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];



$consulta = "SELECT * FROM usuarios WHERE user='$usuario' AND password='$contrasena';";
echo $consulta;
$MyBBDD->consulta($consulta);
$fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

if ($fila == false) { //si el logeo falla
    echo "Datos incorrectos";
 }  else { // si el logeo es exitoso
    $_SESSION['id_empresa'] = $fila['id_empresa'];
    header("location: /curso/Alma-Zen/PRUEBAS/index.php");
     }
