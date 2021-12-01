<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();

$id_empresa = $_SESSION["id_empresa"]; 

//Si la variable de sesion no tiene valor
if(!isset ($id_empresa)){ 
    header("location: sesion/login.php");
}else{
    echo '<h1>BIENVENIDO </h1>';

    //IMPRIME EL BOTON DE SALIR
    echo '<form method="post" action="sesion/salir.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form>'; 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>


    </title>
</head>
<body>
    <h1>AlmaZen</h1>
    <!-- 
        Aquí estaría bien que apareciera el nombre de la empresa,
        como en github, que apareciera por ejemplo: AlmaZen | Copimsa
     -->
    <h3 class="cabecera">Empleados</h3>
 
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

    echo "<table id='tablaHerramientas'><tr>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<tr><td>" . $fila['nombre_empleado'] . " " .
            $fila['apellidos_empleado'] . "</td></tr>";
    }
    echo "</tr></table>";
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


    if (isset($_POST['statusOcup'])) {
        $id_util = $_POST['id_util'];
        $sql =
            "UPDATE utiles 
            SET estado_util = 'ocupado' 
            WHERE id_util = $id_util;
        ";
        $MyBBDD->consulta($sql);
    }

    /*if (isset($_POST['statusEstro'])) {
        
        $sql = "UPDATE utiles 
            SET estado_util = 'ocupado' 
            WHERE id_util = $id_util
            AND id_empresa = $id_empresa;
        ";
        $MyBBDD->consulta($sql);
    }*/

    $sql = "SELECT * FROM utiles
        WHERE id_empresa = $id_empresa;
    ";
    $MyBBDD->consulta($sql);

    echo "<table id='tablaHerramientas'><tr>
    <th>Marca</th><th>Modelo</th><th>Categoría</th><th>Herram</th>
    <th>Libre</th><th>En uso</th><th>Defectuoso</th></tr>";

    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<tr><td>" . $fila['marca_util'] . "</td>" .
            "<td>" . $fila['modelo_util'] . "</td>" .
            "<td>" .   $fila['categoria_util'] . "</td>" .
            "<td>" .    $fila['herramienta_vehiculo'] . "</td>" .
            "<td><input type='submit' value='✔️' name='statusLibre' class='btnLibre'></td>
            <td><button name='statusOcup' class='btnOcupado'>🚫</button></td>
            <td><button name='statusEstro' class='btnEstropeado'>🛠️</button></td></tr>";
    }
    echo "</table>";
    ?>

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
                        <option value="Libre">Libre</option>
                        <option value="Ocupado">Ocupado</option>
                        <option value="Estropeado">Estropeado</option>
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