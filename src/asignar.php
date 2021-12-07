<?php
include 'conect_class.php'; // MUY IMPORTANTE.
include 'funciones.php'; // MUY IMPORTANTE.
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
<a class="active" href="asignar.php">Asignar</a>
<a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
<p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
</div>';





echo"<div class='contenidoFormulario'>"; //abre el div de los select

//------------------------------------
// --------ASIGNA HERRAMIENTAS--------
// -----------------------------------

echo"<div class='asigna-herramientas'>"; //abre el div del select de herramienta


$sql = "SELECT * FROM empleados
        WHERE id_empresa = $id_empresa;
    ";
$MyBBDD->consulta($sql);

echo"
<form  method='post' class='SeleccionaUsuario'>

    <select name='empleado'>";
    echo" <option disabled selected value> -- EMPLEADO -- </option>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_empleado = $fila['id_empleado'];
        $nombre_empleado = $fila['nombre_empleado'];
        $apellidos_empleado = $fila['apellidos_empleado'];
        echo" <option value='$id_empleado'>$nombre_empleado  $apellidos_empleado</option>";
      
    }
    echo"</select>";
    


    $sql = "SELECT * FROM utiles
        WHERE estado_util = 'libre' AND id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta';
    ";
$MyBBDD->consulta($sql);

echo"
    <select name='util'>";
    echo" <option disabled selected value> -- HERRAMIENTA -- </option>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_util = $fila['id_util'];
        $categoria_util = $fila['categoria_util'];
        $marca_util = $fila['marca_util'];
        $modelo_util = $fila['modelo_util'];
      
        echo" <option value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
    }
    echo"</select> <br>
<input type='submit' value='Asignar' name='btn-asignar'>"; 


echo"</div>"; //cierra el div del select de herramienta
// seleccionaAsigna($sql, $MyBBDD, $id_empresa);

//------------------------------------
// --------ASIGNA VEHICULOS-----------
// -----------------------------------

echo"<div class='asigna-vehiculos'>"; //abre el div del select de vehiculos
$sql = "SELECT * FROM empleados
        WHERE id_empresa = $id_empresa;
    ";
$MyBBDD->consulta($sql);

echo"
<form  method='post' class='SeleccionaUsuario'>

    <select name='empleado'>";
    echo" <option disabled selected value> -- EMPLEADO -- </option>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_empleado = $fila['id_empleado'];
        $nombre_empleado = $fila['nombre_empleado'];
        $apellidos_empleado = $fila['apellidos_empleado'];
        echo" <option value='$id_empleado'>$nombre_empleado  $apellidos_empleado</option>";
      
    }
    echo"</select> <br>";
    


    $sql = "SELECT * FROM utiles
        WHERE estado_util = 'libre' AND id_empresa = $id_empresa AND herramienta_vehiculo = 'vehiculo';
    ";
$MyBBDD->consulta($sql);

echo"<select name='util'>";
    echo"<option disabled selected value> -- VEHICULO -- </option>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_util = $fila['id_util'];
        $categoria_util = $fila['categoria_util'];
        $marca_util = $fila['marca_util'];
        $modelo_util = $fila['modelo_util'];
      
        echo" <option value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
    }
    echo"</select> <br>
<input type='submit' value='Asignar' name='btn-asignar'>
"; 

//INSERTA EL REGISTRO EN LA BBDD
if (isset($_POST['btn-asignar']) && $_POST['empleado'] != "" && $_POST['util'] != "") {
    $id_empleado = $_POST['empleado'];
    $id_util = $_POST['util'];
    $fecha_hora = date("Y-m-d H:i:s");
 
    $sql = "INSERT INTO emple_util (id_empleado, id_util, id_empresa, fecha_hora, is_devuelto) 
    VALUES ('$id_empleado','$id_util', '$id_empresa','$fecha_hora', 0);
";
        echo $sql;
    $MyBBDD->consulta($sql);
}

echo"</div>"; //cierra el div del select de vehiculos
echo"</div>"; //cierra el div del select

//------------------------------------
// --------TABLA HERRAMIENTAS---------
// -----------------------------------

$sql = "SELECT empleados.nombre_empleado, empleados.apellidos_empleado, utiles.marca_util, utiles.modelo_util, utiles.categoria_util, emple_util.fecha_hora, emple_util.is_devuelto
FROM ((almazen.emple_util
INNER JOIN almazen.empleados ON almazen.emple_util.id_empleado = almazen.empleados.id_empleado)
INNER JOIN almazen.utiles ON almazen.emple_util.id_util = almazen.utiles.id_util)
WHERE almazen.utiles.herramienta_vehiculo = 'herramienta' AND almazen.emple_util.id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo'<h2>Herramientas</h2>';
echo "<table id='tablaHerramientas'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Devuelto?</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    // AQUÍ SE IMPRIMIRÍA LA TABLA
    echo "<tr id='fila'><td>" . $fila['nombre_empleado']." ".$fila['apellidos_empleado'] ."</td>" .    
        "<td>" . $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['marca_util'] . "</td>" .
        "<td>" .   $fila['modelo_util'] . "</td>" .
        "<td>" . $fila['fecha_hora'] . "</td>" .
      
        "<td><input type='submit' value='✔️' name='tick'></td></tr>";
    
}
echo "</table>";


// ------------------------------------
// --------TABLA VEHICULOS-------------
// ------------------------------------

$sql = "SELECT empleados.nombre_empleado, empleados.apellidos_empleado, utiles.marca_util, utiles.modelo_util, utiles.categoria_util, emple_util.fecha_hora, emple_util.is_devuelto
FROM ((almazen.emple_util
INNER JOIN almazen.empleados ON almazen.emple_util.id_empleado = almazen.empleados.id_empleado)
INNER JOIN almazen.utiles ON almazen.emple_util.id_util = almazen.utiles.id_util)
WHERE almazen.utiles.herramienta_vehiculo = 'vehiculo'AND almazen.emple_util.id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo'<h2>Vehiculos</h2>';
echo "<table id='tablaHerramientas'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Devuelto?</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    

    // AQUÍ SE IMPRIMIRÍA LA TABLA
    echo "<tr id='fila'><td>" . $fila['nombre_empleado']." ".$fila['apellidos_empleado'] ."</td>" .    
        "<td>" . $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['marca_util'] . "</td>" .
        "<td>" .   $fila['modelo_util'] . "</td>" .
         "<td>" . $fila['fecha_hora'] . "</td>" .

      
        "<td><input type='submit' value='✔️' name='tick'></td></tr>";
    
}
echo "</table>";
