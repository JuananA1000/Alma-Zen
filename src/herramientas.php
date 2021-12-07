<?php
include 'conect_class.php'; // MUY IMPORTANTE.
include 'funciones.php';
session_start();

//Recogemos las variables de sesión
$id_empresa = $_SESSION["id_empresa"];
$nombre_empresa = $_SESSION["nombre_empresa"];

//Si la variable de sesion no tiene valor
if (!isset($id_empresa)) {
    header("location: sesion/login.php");
}

echo '<title>' .
    $nombre_empresa . '</title>';
echo '<link rel="stylesheet" type="text/css" href="css/style.css" />'; //LLAMAMOS AL CSS
echo '<h1>ALMA-ZEN</h1>';
echo '
<div class="topnav">
    <a  href="index.php">Home</a>
    <a href="empleados.php">Empleados</a>
    <a class="active" href="herramientas.php">Herramientas</a>
    <a href="vehiculos.php">Vehículos</a>
    <a href="asignar.php">Asignar</a>
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

echo "<table class='tabla'><tr>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoría</th>
    <th>Herram</th>
    <th>Libre</th>
    <th>En uso</th>
    <th>Defectuoso</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    $id_util = $fila['id_util'];

    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>".
        "<td><button name='statusOcup' class='btnLibre'>✔️</button></td>" .
        "<td><button name='statusOcup' class='btnOcupado'>🚫</button></td>" .
        "<td><button name='statusEstro' class='btnEstropeado'>🛠️</button></td></tr>";
}
echo "</table>";

echo '
<div class="contenidoFormulario">
<form method="POST">
    <fieldset>
        <legend>Herramientas</legend>
        <div>
            <label>Marca</label><br>
            <input type="text" name="marca_util"></p>
        </div>
        <div>   
            <label>Modelo</label><br>
            <input type="text" name="modelo_util"></p>
        </div>
        <div>
            <label>Categoría</label><br>
            <input type="text" name="categoria_util"><br>
        </div>
        <div>    
            <label>Herramienta o Vehículo</label><br>
            <select name="herramienta_vehiculo">
                <option value="herramienta">herramienta</option>
                <option value="vehiculo">vehiculo</option>
            </select>
        </div>
        <div>
        <label>Estado</label><br> 
            <select name="estado_util">
                <option value="libre">libre</option>
                <option value="ocupado">ocupado</option>
                <option value="estropeado">estropeado</option>
            </select>
        </div> 
        <div>
            <input type="submit" name="addHerr" value="Insertar Herramienta">
        </div>
    </fieldset>
</form>
</div>
<footer>Juan Antonio Amil y Antonio Marín, 2021</footer>
<script src="./javaScript/main.js"></script>
';
?>