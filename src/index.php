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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>
        <?php
        echo $nombre_empresa;
        ?>
    </title>
</head>

<body>

    <h1>ALMA-ZEN</h1>

    <?php
    echo '<div class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="empleados.php">Empleados</a>
    <a href="herramientas.php">Herramientas</a>
    <a href="vehiculos.php">Vehículos</a>
    <a href="historial.php">Historial</a>
    <a class="cerrar-sesion" href="sesion/salir.php"><img src="../img/logo-azul-32.png"></a>
    <p class="nombre_empresa">' . strtoupper($nombre_empresa) . '</p>
    </div>';

    echo"<div class='asignadores'>"; //abre el div de los select

    //------------------------------------
    // --------ASIGNA HERRAMIENTAS--------
    // -----------------------------------
    
    echo"<div class='asigna'>"; //abre el div del select de herramienta
    
    
    $sql = "SELECT * FROM empleados
            WHERE id_empresa = $id_empresa;
        ";
    $MyBBDD->consulta($sql);
    
    echo"
    <form  method='post' class='SeleccionaUsuario'>
    
    <div> <select name='empleado'>";
        echo" <option disabled selected value> -- EMPLEADO -- </option>";
        while ($fila = $MyBBDD->extraerRegistro()) {
            $id_empleado = $fila['id_empleado'];
            $nombre_empleado = $fila['nombre_empleado'];
            $apellidos_empleado = $fila['apellidos_empleado'];
            echo" <option value='$id_empleado'>$nombre_empleado  $apellidos_empleado</option>";
          
        }
        echo"</select></div>
        <br>";
        
    
    
        $sql = "SELECT * FROM utiles
            WHERE estado_util = 'libre' AND id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta';
        ";
    $MyBBDD->consulta($sql);
    
    echo"
    <div><select name='util'>";
        echo" <option disabled selected value> -- HERRAMIENTA -- </option>";
        while ($fila = $MyBBDD->extraerRegistro()) {
            $id_util = $fila['id_util'];
            $categoria_util = $fila['categoria_util'];
            $marca_util = $fila['marca_util'];
            $modelo_util = $fila['modelo_util'];
          
            echo" <option name='util' value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
        }
        echo"</select></div> <br>
        <div><input type='submit' value='Asignar herramienta' name='btn-asignar'></form></div>"; 
    
    
    echo"</div>"; //cierra el div del select de herramienta
    // seleccionaAsigna($sql, $MyBBDD, $id_empresa);
    
    //------------------------------------
    // --------ASIGNA VEHICULOS-----------
    // -----------------------------------
    
    echo"<div class='asigna'>"; //abre el div del select de vehiculos
    $sql = "SELECT * FROM empleados
            WHERE id_empresa = $id_empresa;
        ";
    $MyBBDD->consulta($sql);
    
    echo"
    <form  method='post' class='SeleccionaUsuario'>
        <div>
        <select name='empleado'>";
        echo" <option disabled selected value> -- EMPLEADO -- </option>";
        while ($fila = $MyBBDD->extraerRegistro()) {
            $id_empleado = $fila['id_empleado'];
            $nombre_empleado = $fila['nombre_empleado'];
            $apellidos_empleado = $fila['apellidos_empleado'];
            echo" <option value='$id_empleado'>$nombre_empleado  $apellidos_empleado</option>";
          
        }
        echo"</select>
        </div>
        <br>";
        
    
    
        $sql = "SELECT * FROM utiles
            WHERE estado_util = 'libre' AND id_empresa = $id_empresa AND herramienta_vehiculo = 'vehiculo';
        ";
    $MyBBDD->consulta($sql);
    
    echo"<div>
    <select name='util'>";
        echo"<option disabled selected value> -- VEHICULO -- </option>";
        while ($fila = $MyBBDD->extraerRegistro()) {
            $id_util = $fila['id_util'];
            $categoria_util = $fila['categoria_util'];
            $marca_util = $fila['marca_util'];
            $modelo_util = $fila['modelo_util'];
          
            echo" <option name='util' value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
        }
        echo"</select></div>
        <br> 
        <div><input type='submit' value='Asignar vehículo' name='btn-asignar'></form></div>
    "; 
    echo"</div>"; //cierra el div del select de vehiculos
    echo"</div>"; //cierra el div del select
    


//INSERTA EL REGISTRO EN LA BBDD
if (isset($_POST['btn-asignar']) && $_POST['empleado'] != "" && $_POST['util'] != "") {
    $id_empleado = $_POST['empleado'];
    $id_util = $_POST['util'];
    $fecha_hora = date("Y-m-d H:i:s");
 
    $relacion = "INSERT INTO emple_util (id_empleado, id_util, id_empresa, fecha_hora, is_devuelto) 
    VALUES ('$id_empleado','$id_util', '$id_empresa','$fecha_hora', 0);";

    $cambioEstado = "UPDATE almazen.utiles SET almazen.utiles.estado_util='ocupado' WHERE almazen.utiles.id_util=$id_util;";   
      
        
    $MyBBDD->consulta($relacion);
    $MyBBDD->consulta($cambioEstado);
    header("Refresh:0");
}
    ?>

</body>

</html>