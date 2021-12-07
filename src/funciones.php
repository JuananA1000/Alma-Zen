<?php

//include 'conect_class.php'; // MUY IMPORTANTE.
// include 'funciones.php'; // MUY IMPORTANTE.
// session_start();

// //Recogemos las variables de sesión
// $id_empresa = $_SESSION["id_empresa"];
// $nombre_empresa = $_SESSION["nombre_empresa"];



// function seleccionaAsigna($sql,$MyBBDD ,$id_empresa) {



// //------------------------------------
// // --------ASIGNA HERRAMIENTAS--------
// // -----------------------------------

// $sql = "SELECT * FROM empleados
//         WHERE id_empresa = $id_empresa;
//     ";
// $MyBBDD->consulta($sql);

// echo"<div>
// <form  method='post' class='SeleccionaUsuario'>
// <label>Selecciona un usuario</label><br> 
//     <select name='empleado'>";
//     echo" <option disabled selected value> -- EMPLEADO -- </option>";
//     while ($fila = $MyBBDD->extraerRegistro()) {
//         $id_empleado = $fila['id_empleado'];
//         $nombre_empleado = $fila['nombre_empleado'];
//         $apellidos_empleado = $fila['apellidos_empleado'];
//         echo" <option value='$id_empleado'>$nombre_empleado  $apellidos_empleado</option>";
      
//     }
//     echo"</select>";
    


//     $sql = "SELECT * FROM utiles
//         WHERE estado_util = 'libre' AND id_empresa = $id_empresa AND herramienta_vehiculo = 'herramienta';
//     ";
// $MyBBDD->consulta($sql);

// echo"<div>
//     <label>Selecciona una herramienta</label><br> 
//     <select name='util'>";
//     echo" <option disabled selected value> -- HERRAMIENTA -- </option>";
//     while ($fila = $MyBBDD->extraerRegistro()) {
//         $id_util = $fila['id_util'];
//         $categoria_util = $fila['categoria_util'];
//         $marca_util = $fila['marca_util'];
//         $modelo_util = $fila['modelo_util'];
      
//         echo" <option value='$id_util'>$categoria_util $marca_util  $modelo_util</option>";
//     }
//     echo"</select>
// <input type='submit' value='Asignar' name='btn-asignar'>
// </div>"; 

// if (isset($_POST['btn-asignar']) && $_POST['empleado'] != "" && $_POST['util'] != "") {
//     $id_empleado = $_POST['empleado'];
//     $id_util = $_POST['util'];
//     $fecha_hora = date("h:i:s");
 

//     $sql = "INSERT INTO emple_util (id_empleado, id_util, fecha_hora, is_devuelto, incidencia) 
//             VALUES ('$id_empleado','$id_util','$fecha_hora', 0,'');
//         ";
        
//     $MyBBDD->consulta($sql);
// }


// }



?>