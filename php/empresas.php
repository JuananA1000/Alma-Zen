<?php
include("conect_class.php");

$id_empresa = $_GET['id_empresa']; // el id_empresa de la empresa

// 4. Y los mostramos tambien en el DOM

$sql = "SELECT * FROM empresas
    WHERE id_empresa = $id_empresa;
";
$MyBBDD->consulta($sql);

$fila = $MyBBDD->extraerRegistro();
echo "<h1>" . $fila['nombre_empresa'] . "</h1>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Alma-Zen/css/estilo.css">
    <title>
        <?php
        echo $fila['nombre_empresa']; // El nombre de cada empresa aparecerá en la pestaña del navegador
        ?>
    </title>

</head>

<body>

    <?php
    echo "<h2> Empleados</h2>"; // ------------ IMPRIMIMOS LOS EMPLEADOS ----------------

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

    while ($fila = $MyBBDD->extraerRegistro()) {
        echo $fila['nombre_empleado'] . " - " . $fila['apellidos_empleado'] . "<br>";
    }

    echo "<h2> Herramientas</h2>"; // ------------ IMPRIMIMOS LOS EMPLEADOS ----------------

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

        $sql = "SELECT * FROM utiles
        WHERE id_empresa = $id_empresa;
    ";
        $MyBBDD->consulta($sql);

        while ($fila = $MyBBDD->extraerRegistro()) {
            echo $fila['marca_util'] . " - " .
                $fila['modelo_util'] . " - " .
                $fila['categoria_util'] . " - " .
                $fila['estado_util'] . " - " .
                $fila['herramienta_vehiculo'] . "<br>";
        }
    }
    ?>
    <div>
        <form method="POST">
            <fieldset>
                <legend>Empleados</legend>
                <p> Nombre<input type="text" name="nombre_empleado"></p>
                <p>Apellidos<input type="text" name="apellidos_empleado"></p>
            </fieldset>
            <input type="submit" name="addEmple" value="insertar empleado">
        </form>
    </div>

    <div>
        <form method="POST">
            <fieldset>
                <legend>Herramientas</legend>
                <p>Marca: <input type="text" name="marca_util"></p>
                <p>Modelo: <input type="text" name="modelo_util"></p>
                <p>Catgoría: <input type="text" name="categoria_util"></p>
                <p>Herramienta: <input type="text" name="herramienta_vehiculo"></p>
                <p>Estado: <input type="text" name="estado_util"></p>
            </fieldset>
            <input type="submit" name="addHerr" value="insertar HERRAMIENTA">
        </form>
    </div>
</body>

</html>