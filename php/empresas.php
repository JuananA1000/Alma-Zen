<?php
include("conect_class.php");

$id_empresa = $_GET['id_empresa']; // el id_empresa de la empresa

// 4. Y los mostramos tambien en el DOM

$sql = "SELECT * FROM empresas
    WHERE id_empresa = $id_empresa;
";
$MyBBDD->consulta($sql);

$fila = $MyBBDD->extraerRegistro();
echo "<h1>AlmaZen | " . $fila['nombre_empresa'] . "</h1>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>
        <?php
        echo $fila['nombre_empresa']; // El nombre de cada empresa aparecerá en la pestaña del navegador
        ?>
    </title>
</head>

<body>
    <h3 class="cabecera"> Empleados</h3>

    <?php

    if (isset($_POST['addEmple'])) {
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

    echo "<div class='contenidoTabla'>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<p>" . $fila['nombre_empleado'] . " " .
            $fila['apellidos_empleado'] . "</p>";
    }
    echo "</div>"
    ?>

    <h3 class="cabecera"> Herramientas</h3>

    <?php

    if (isset($_POST['addHerr'])) {
        $marca_util = $_POST['marca_util'];
        $modelo_util = $_POST['modelo_util'];
        $categoria_util = $_POST['categoria_util'];
        $herramienta_vehiculo = $_POST['herramienta_vehiculo'];
        $estado_util = $_POST['estado_util'];

        $sql = "INSERT INTO utiles (marca_util, modelo_util, categoria_util, estado_util, herramienta_vehiculo, id_empresa) 
            VALUES ('$marca_util','$modelo_util','$categoria_util','$estado_util','$herramienta_vehiculo', '$id_empresa');
        ";
        $MyBBDD->consulta($sql);
    }

    $sql = "SELECT * FROM utiles
        WHERE id_empresa = $id_empresa;
    ";
    $MyBBDD->consulta($sql);

    echo "<div class='contenidoTabla'>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<p>" . $fila['marca_util'] . " - " .
            $fila['modelo_util'] . " - " .
            $fila['categoria_util'] . " - " .
            $fila['estado_util'] . " - " .
            $fila['herramienta_vehiculo'] . 
            "<button id='btnLibre'>✔️</button>
            <button id='btnOcupado'>❌</button>
            <button id='btnReparar'>🛠️</button>".
            "</p>";
    }
    echo "</div>";
    ?>

    <div class="contenedorFormularios">
        <form method="POST" class="formulario">
            <fieldset>
                <legend>Empleados</legend>
                <p>Nombre: <input type="text" name="nombre_empleado"></p>
                <p>Apellidos: <input type="text" name="apellidos_empleado"></p>
                <input type="submit" name="addEmple" value="Insertar Empleado">

            </fieldset>
        </form>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Herramientas</legend>
                <p>Marca: <input type="text" name="marca_util"></p>
                <p>Modelo: <input type="text" name="modelo_util"></p>
                <p>Categoría: <input type="text" name="categoria_util"></p>
                <p>Herramienta: <input type="text" name="herramienta_vehiculo"></p>
                <p>Estado: <select name="estado_util">
                        <option value="Ocupado">Ocupado</option>
                        <option value="Libre">Libre</option>
                        <option value="Estropeado">Estropeado</option>
                    </select>
                </p>
                <input type="submit" name="addHerr" value="Insertar Herramienta">
            </fieldset>
        </form>
    </div>

    <hr>
    <footer>Juan Antonio Amil y Antonio Marín</footer>

    <script src="main.js"></script>
</body>

</html>