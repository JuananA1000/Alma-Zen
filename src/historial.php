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


echo '<div class="topnav">
<a  href="index.php">Home</a>
<a href="empleados.php">Empleados</a>
<a  href="herramientas.php">Herramientas</a>
<a href="vehiculos.php">Vehículos</a>
<a class="active" href="historial.php">Historial</a>
<a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
<p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
</div>';





//------------------------------------
// --------TABLA HERRAMIENTAS---------
// -----------------------------------

$sql = "SELECT empleados.nombre_empleado, empleados.apellidos_empleado, utiles.marca_util, utiles.modelo_util, 
                utiles.categoria_util, emple_util.fecha_hora, emple_util.is_devuelto, emple_util.id_emple_util
FROM ((almazen.emple_util
INNER JOIN almazen.empleados ON almazen.emple_util.id_empleado = almazen.empleados.id_empleado)
INNER JOIN almazen.utiles ON almazen.emple_util.id_util = almazen.utiles.id_util)
WHERE almazen.emple_util.is_devuelto = 0 AND almazen.utiles.herramienta_vehiculo = 'herramienta' AND almazen.emple_util.id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo'<h2 class="pretabla">Herramientas pendientes de entrega</h2>';
echo "<table class='tabla'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Recoger</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    // AQUÍ SE IMPRIMIRÍA LA TABLA
    $id = $fila['id_emple_util'];
    echo "<tr id='fila'><td>" . $fila['nombre_empleado']." ".$fila['apellidos_empleado'] ."</td>" .    
        "<td>" . $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['marca_util'] . "</td>" .
        "<td>" .   $fila['modelo_util'] . "</td>" .
        "<td>" . $fila['fecha_hora'] . "</td>" .
        "<form  method='post'>".
        "<input name='id' type='hidden' value=$id>".
        "<td><input class='btnRecoger' type='submit' value='Recoger' name='btnRecoger'></td></tr>".
        "</form>";
    
}
echo "</table>";


// ------------------------------------
// --------TABLA VEHICULOS-------------
// ------------------------------------

$sql = "SELECT empleados.nombre_empleado, empleados.apellidos_empleado, utiles.marca_util, utiles.modelo_util, 
                utiles.categoria_util, emple_util.fecha_hora, emple_util.is_devuelto, emple_util.id_emple_util
FROM ((almazen.emple_util
INNER JOIN almazen.empleados ON almazen.emple_util.id_empleado = almazen.empleados.id_empleado)
INNER JOIN almazen.utiles ON almazen.emple_util.id_util = almazen.utiles.id_util)
WHERE   almazen.emple_util.is_devuelto = 0 AND almazen.utiles.herramienta_vehiculo = 'vehiculo'AND almazen.emple_util.id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo'<h2 class="pretabla">Vehículos pendientes de entrega</h2>';
echo "<table class='tabla'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Recoger</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    $id = $fila['id_emple_util'];
    // AQUÍ SE IMPRIMIRÍA LA TABLA
    echo "<tr id='fila'><td>" . $fila['nombre_empleado']." ".$fila['apellidos_empleado'] ."</td>" .    
        "<td>" . $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['marca_util'] . "</td>" .
        "<td>" .   $fila['modelo_util'] . "</td>" .
         "<td>" . $fila['fecha_hora'] . "</td>" .
         "<form  method='post'>".
         "<input name='id' type='hidden' value=$id>".
         "<td><input class='btnRecoger' type='submit' value='Recoger' name='btnRecoger'></td></tr>".
         "</form>";
    
}
echo "</table>";


// ------------------------------------
// --------TABLA DEVUELTOS-------------
// ------------------------------------

$sql = "SELECT empleados.nombre_empleado, empleados.apellidos_empleado, utiles.marca_util, utiles.modelo_util, utiles.id_util,
                 utiles.categoria_util, emple_util.fecha_hora, emple_util.is_devuelto
FROM ((almazen.emple_util
INNER JOIN almazen.empleados ON almazen.emple_util.id_empleado = almazen.empleados.id_empleado)
INNER JOIN almazen.utiles ON almazen.emple_util.id_util = almazen.utiles.id_util)
WHERE  almazen.emple_util.is_devuelto = 1 AND almazen.emple_util.id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo'<h2 class="pretabla">HISTORIAL</h2>';
echo "<table class='tabla'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Estado</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    

    // AQUÍ SE IMPRIMIRÍA LA TABLA
    echo "<tr id='fila'><td>" . $fila['nombre_empleado']." ".$fila['apellidos_empleado'] ."</td>" .    
        "<td>" . $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['marca_util'] . "</td>" .
        "<td>" .   $fila['modelo_util'] . "</td>" .
         "<td>" . $fila['fecha_hora'] . "</td>" .

      
        "<td>Devuelto</td></tr>";
    
}
echo "</table>";

//SI PULSAMOS "RECOGER"
if (isset($_POST['btnRecoger'])){
    $id = $_POST['id'];
    $id_util = $_POST['id_util'];
 
    $isDevuelto = "UPDATE almazen.emple_util SET almazen.emple_util.is_devuelto=1 WHERE almazen.emple_util.id_emple_util=$id;";
    $cambioEstado = "UPDATE almazen.utiles SET almazen.utiles.estado_util='libre' WHERE almazen.utiles.id_util=$id_util;";   
        
    $MyBBDD->consulta($isDevuelto);
    $MyBBDD->consulta($cambioEstado);
    header("Refresh:0");
}