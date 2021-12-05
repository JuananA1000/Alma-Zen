<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();
//Recogemos las variables de sesión
$id_empresa = $_SESSION["id_empresa"];
$nombre_empresa = $_SESSION["nombre_empresa"];
echo '<title>' .
    $nombre_empresa . '</title>';
echo '<link rel="stylesheet" type="text/css" href="style.css" />'; //LLAMAMOS AL CSS

echo '<h1>ALMA-ZEN</h1>';

echo '<div class="topnav">
<a  href="index.php">Home</a>
<a href="empleados.php">Empleados</a>
<a class="active" href="herramientas.php">Herramientas</a>
<a href="vehiculos.php">Vehículos</a>
<a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
<p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
</div>';

if (isset($_POST['addHerr']) && $_POST['marca_util'] != "") {
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
        WHERE id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta';
    ";
$MyBBDD->consulta($sql);

echo "<table id='tablaHerramientas'><tr>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoría</th>
    <th>Herram</th>
    <th>Libre</th>
    <th>En uso</th>
    <th>Defectuoso</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" .    $fila['herramienta_vehiculo'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>" .
        "<td><input type='submit' value='✔️' name='tick'></td></tr>";
    // <td><button name='statusOcup' class='btnOcupado'>🚫</button></td>
    // <td><button name='statusEstro' class='btnEstropeado'>🛠️</button></td></tr>";
}
echo "</table>";

echo '
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

<footer>Juan Antonio Amil y Antonio Marín, 2021</footer>
';
