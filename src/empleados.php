<?php
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
