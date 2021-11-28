<?php
include ('conect_class.php');
include('php/index.php');

$_GET['id_empresa'];
$usuariook = "SELECT user FROM usuarios WHERE id_empresa = '$id_empresa';";
$passok =  "SELECT password FROM usuarios WHERE id_empresa = '$id_empresa';";

if ($_POST['nombre'] == $usuariook && $_POST['pass'] == $passok) {
	session_start();
	$_SESSION["verificado"] = "si";
	echo "Tienes acceso a la página privada";
	echo "<a href='index.php'>Ve a ver el contenido privado!!</a>";
}