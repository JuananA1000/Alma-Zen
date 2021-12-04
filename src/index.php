<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();

//Recogemos las variables de sesión
$id_empresa = $_SESSION["id_empresa"];
$nombre_empresa = $_SESSION["nombre_empresa"];

//Si la variable de sesion no tiene valor
if (!isset($id_empresa)) {
    header("location: sesion/login.php");
}
//  else {
//     echo "<h1>Bienvenido al AlmaZen de $nombre_empresa</h1>";

//     //IMPRIME EL BOTON DE SALIR
//     echo '
//     <form method="post" action="sesion/salir.php">
//         <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
//     </form>';
// }


echo '<div class="topnav">
<a class="active" href="index.php">Home</a>
<a href="empleados.php">Empleados</a>
<a href="herramientas.php">Herramientas</a>
<a href="#about">About</a>
<a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
<p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
</div>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>
        <?php
        echo $nombre_empresa;
        ?>
    </title>
</head>

<body>

    <h1>ALMA-ZEN</h1>

    <div class="contenidoFormulario">
        <form method="POST">
            <fieldset>
                <legend>Empleados</legend>
                <p>Nombre: <input type="text" name="nombre_empleado"></p>
                <p>Apellidos: <input type="text" name="apellidos_empleado"></p>
                <input type="submit" name="addEmple" value="Insertar Empleado">
            </fieldset>
        </form>
    </div>

    <div class="contenidoFormulario">
        <form method="POST">
            <fieldset>
                <legend>Herramientas</legend>
                <p>Marca: <input type="text" name="marca_util"></p>
                <p>Modelo: <input type="text" name="modelo_util"></p>
                <p>Categoría: <input type="text" name="categoria_util"></p>
                <p>Herramienta: <input type="text" name="herramienta_vehiculo"></p>
                <p>Estado: <select name="estado_util">
                        <option value="libre">libre</option>
                        <option value="ocupado">ocupado</option>
                        <option value="estropeado">estropeado</option>
                    </select>
                </p>
                <input type="submit" name="addHerr" value="Insertar Herramienta">
            </fieldset>
        </form>
    </div>
    <script src="javaScript/main.js"></script>
    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>
</body>

</html>