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

    <h3>Empleados</h3>
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

    while ($fila = $MyBBDD->extraerRegistro()) {
        echo $fila['nombre_empleado']." " .$fila['apellidos_empleado']. "<br>";
    }

    ?>

    <div>
        <h3>EMPLEADOS</h3>
        <form method="POST">
           <p> Nombre<input type="text" name="nombre_empleado"></p>
           <p>Apellidos<input type="text" name="apellidos_empleado"></p>
            <input type="submit" name="addEmple" value="insertar impleado">
        </form>
    </div>









</body>

</html>