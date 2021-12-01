<?php
include '../conect_class.php'; // MUY IMPORTANTE.
session_start();

//Recoge las variables del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];



$consultaLogin = "SELECT * FROM usuarios WHERE user='$usuario' AND password='$contrasena';";

$MyBBDD->consulta($consultaLogin);
$fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

if ($fila == false) { //si el logeo falla
   // echo "Datos incorrectos";
   header("location: login.php"); //Nos lleva a login
} else { // si el logeo es exitoso
   //CREAMOS LA VARIABLE SESION CON EL NOMBRE DE LA EMPRESA
   $_SESSION['id_empresa'] = $fila['id_empresa'];
   $id_empresa = $fila['id_empresa']; //Esta variable es necesaria porque si hago la sentencia con $sesion o $fila me peta por las comillas

   //CREAMOS LA VARIABLE SESION CON EL NOMBRE DE LA EMPRESA
   $consultaNombreEmpresa = "SELECT nombre_empresa FROM empresas WHERE  id_empresa='$id_empresa';";
   $MyBBDD->consulta($consultaNombreEmpresa);
   $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia
   $_SESSION['nombre_empresa'] = $fila['nombre_empresa'];

   header("location: ../index.php"); 
}
