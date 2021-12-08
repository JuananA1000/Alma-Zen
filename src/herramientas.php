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
    

    $sql = "INSERT INTO utiles (marca_util, modelo_util, categoria_util, estado_util, herramienta_vehiculo, id_empresa) 
            VALUES ('$marca_util','$modelo_util','$categoria_util','libre','herramienta', '$id_empresa');
        ";
    $MyBBDD->consulta($sql);
}



//TABLA DISPONIBLES
echo'<h2 class="pretabla">Herramientas disponibles</h2>';
echo "<table class='tabla'><tr>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoría</th>
    <th>Eestado</th>
    
    <th>Llevar a reparar</th></tr>";

    $sql = "SELECT * FROM utiles
        WHERE id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta'AND estado_util = 'libre';
    ";
$MyBBDD->consulta($sql);

while ($fila = $MyBBDD->extraerRegistro()) {
    $id_util = $fila['id_util'];

    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>".
        "<form  method='post'>".
        "<input name='id' type='hidden' value=$id_util>".
        "<td><input class='btnRecoger' type='submit' value='A reparar' name='btnReparar'></td></tr>".
        "</form>";
}
echo "</table>";


//TABLA EN REPARACION
echo'<h2 class="pretabla">Herramientas en reparación</h2>';
echo "<table class='tabla'><tr>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoría</th>
    <th>Eestado</th>
    
    <th>Devolver herramienta</th></tr>";

    $sql = "SELECT * FROM utiles
        WHERE id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta'AND estado_util = 'reparando';
    ";
$MyBBDD->consulta($sql);

while ($fila = $MyBBDD->extraerRegistro()) {
    $id_util = $fila['id_util'];

    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>".
        "<form  method='post'>".
        "<input name='id' type='hidden' value=$id_util>".
        "<td><input class='btnRecoger' type='submit' value='Devolver' name='btnArreglado'></td></tr>".
        "</form>";
}
echo "</table>";

echo '
<div class="Formulario">

<form method="POST">
    <fieldset>
        
        <div>
            <label>Marca</label><br>
            <input class="campo-insertar" type="text" name="marca_util"></p>
        </div>
        <div>   
            <label>Modelo</label><br>
            <input class="campo-insertar" type="text" name="modelo_util"></p>
        </div>
        <div>
            <label>Categoría</label><br>
            <input class="campo-insertar" type="text" name="categoria_util"><br>
        </div>
        <div>
            <input id="btn-insertar" type="submit" name="addHerr" value="Insertar Herramienta">
        </div>
    </fieldset>
</form>
</div>';

//SI PULSAMOS "A REPARAR"
if (isset($_POST['btnReparar'])){
    echo'hola';
    $id = $_POST['id'];
    echo $id;
    $sql = "UPDATE almazen.utiles SET almazen.utiles.estado_util='reparando' WHERE almazen.utiles.id_util=$id;";   
    $MyBBDD->consulta($sql);
    header("Refresh:0");
}

//SI PULSAMOS "ARREGLADO"
if (isset($_POST['btnArreglado'])){
    $id = $_POST['id'];
 
    $sql = "UPDATE almazen.utiles SET almazen.utiles.estado_util='libre' WHERE almazen.utiles.id_util=$id;";
        
    $MyBBDD->consulta($sql);
    header("Refresh:0");
}

?>