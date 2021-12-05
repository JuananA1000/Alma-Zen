<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();
//Recogemos las variables de sesión
$id_empresa = $_SESSION["id_empresa"];
$nombre_empresa = $_SESSION["nombre_empresa"];

echo '<link rel="stylesheet" type="text/css" href="style.css" />'; //LLAMAMOS AL CSS

//DIBUJAMOS EL NAVBAR

echo '<div class="topnav">
<a href="index.php">Home</a>
<a class="active" href="empleados.php">Empleados</a>
<a href="herramientas.php">Herramientas</a>
<a href="vehiculos.php">Vehículos</a>
<a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
<p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
</div>';


echo '<h3 class="cabecera">Empleados</h3>';

    if (isset($_POST['addEmple']) &&  $_POST['nombre_empleado'] != "") {
        $nombre_empleado = $_POST['nombre_empleado'];
        $apellidos_empleado = $_POST['apellidos_empleado'];

        $sql = "INSERT INTO empleados (nombre_empleado, apellidos_empleado, id_empresa) 
            VALUES ('$nombre_empleado','$apellidos_empleado', '$id_empresa');
        ";
        $MyBBDD->consulta($sql);
    }

    $sql = "SELECT * FROM empleados
        WHERE id_empresa = $id_empresa;
    ";
    $MyBBDD->consulta($sql);

    echo "<table id='tablaHerramientas'><tr>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<tr><td>" . $fila['nombre_empleado'] . " " .
            $fila['apellidos_empleado'] . "</td></tr>";
    }
    echo "</tr></table>";
