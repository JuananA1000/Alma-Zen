<?php
include("conect_class.php");

$id = $_GET['id']; // el id de la empresa

// 4. Y los mostramos tambien en el DOM

$sql = "SELECT * FROM empresas
    WHERE id = $id;
";
$MyBBDD->consulta($sql);

$fila = $MyBBDD->extraerRegistro();
echo "<h1>" . $fila['Nombre_Empresa'] . "</h1>";
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
        echo $fila['Nombre_Empresa']; // El nombre de cada empresa aparecerá en la pestaña del navegador
        ?>
    </title>

</head>

<body>


    <?php
    /*
        PENDIENTE: Aquí irán apareciendo elementos <div> que agruparán los distintos
        elementos intriducidos por formulario
    */
    ?>



    <div id="formularios">
        <div>
            <h3>EMPLEADOS</h3>
            <form action="">
                <input type="text" value="">
                <input type="submit" name="addEmple" value="insertar impleado">
            </form>
        </div>


        <div>
            <h3>ÚTILES</h3>
            <form action="">
                <input type="text" value="">
                <input type="submit" name="addEmple" value="insertar impleado">
            </form>
        </div>
    </div>













</body>

</html>