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
echo '<link rel="stylesheet" type="text/css" href="style.css" />'; //LLAMAMOS AL CSS


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







$sql = "SELECT * FROM empleados
        WHERE id_empresa = $id_empresa;
    ";
$MyBBDD->consulta($sql);


    

echo"<div>
<form  method='post' class='SeleccionaUsuario'>
<label>Selecciona un usuario</label><br> 
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
        WHERE estado_util = 'libre' AND id_empresa = $id_empresa ;
    ";
$MyBBDD->consulta($sql);

echo"<div>
    <label>Selecciona una herramienta</label><br> 
    <select name='util'>";
    echo" <option disabled selected value> -- HERRAMIENTA -- </option>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_util = $fila['id_util'];
        $categoria_util = $fila['categoria_util'];
        $marca_util = $fila['marca_util'];
        $modelo_util = $fila['modelo_util'];
      
        echo" <option value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
    }
    echo"</select>
<input type='submit' value='Asignar' name='btn-asignar'>
</div>"; 

if (isset($_POST['btn-asignar']) && $_POST['empleado'] != "" && $_POST['util'] != "") {
    $id_empleado = $_POST['empleado'];
    $id_util = $_POST['util'];
    $fecha_hora = date("h:i:s");
 

    $sql = "INSERT INTO emple_util (id_empleado, id_util, fecha_hora, is_devuelto, incidencia) 
            VALUES ('$id_empleado','$id_util','$fecha_hora', 0,'');
        ";
        echo $sql;
    $MyBBDD->consulta($sql);
}





$sql = "SENTENCIA
    ";
$MyBBDD->consulta($sql);

echo "<table id='tablaHerramientas'><tr>
    <th>Empleado</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Categoria</th>
    <th>Fecha</th>
    <th>Devuelto?</th></tr>";

while ($fila = $MyBBDD->extraerRegistro()) {
    // AQUÍ SE IMPRIMIRÍA LA TABLA
    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>" .
        "<td><input type='submit' value='✔️' name='tick'></td></tr>";
    
}
echo "</table>";





 
?>
