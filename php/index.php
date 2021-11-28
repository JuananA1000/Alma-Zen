<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();

$id_empresa = $_SESSION["id_empresa"];

if(!isset ($id_empresa)){
    header("location: sesion/login.php");
}else{
    echo '<h1>BIENVENIDO </h1>';
    echo '<form method="post" action="sesion/salir.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form>'; //IMPRIME EL BOTON DE SALIR
}

// if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php

//     $user = $_POST["user"];
//     $pass = $_POST["password"];



//     //      --- COMPROBAMOS QUE EL USUARIO PERTENECE A LA BBDD
//     $consulta = "SELECT * FROM usuarios WHERE user='$user' AND password='$pass';";
//     echo $consulta;
//     $MyBBDD->consulta($consulta);
//     $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia

//     if ($fila == false) { //si el logeo falla
//         echo "Datos incorrectos";
//     } else { // si el logeo es exitoso

//         //  CREAMOS LA COOKIE 'Estado' CON EL ID DE LA EMPRESA
//         $_COOKIE['UserId'] = $fila['id_user'];
//         if (!isset($_COOKIE['Estado'])) {
//             setcookie("Estado", $fila['id_empresa'], time() + 86400, "/");
//         } else {
//             $_COOKIE['Estado'] = $fila['id_empresa'];
//         }

//         //  CREAMOS LA COOKIE 'UserId' CON EL ID DE LA EMPRESA
//         if (!isset($_COOKIE['UserId'])) {
//             setcookie("UserId", $fila['id_user'], time() + 86400, "/");
//         } else {
//             $_COOKIE['UserId'] = $fila['id_user'];
//         }
       
//         echo 'Sesión iniciada con éxito. Usuario: ' .  $fila['user'] . ' Id del usuario: ' .  $_COOKIE['UserId'];
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Inicio</title>
</head>
<!-- Imprimimos el boton Iniciar sesion -->
<!-- <form method="post" action="login.php">
    <input type="submit" value="Iniciar Sesión" name="inicia-sesion">
</form> -->

<!-- Imprimimos el boton de cerrar sesión sesion -->
<!-- <form method="post" action="login.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form> -->


<body>
    <h1>ALMA-ZEN</h1>

    <!-- <p>Inicio Sesión</p> -->

    <?php

    // CIERRA LA SESION
    // if (isset($_POST['cierra-sesion'])) {
    //     $_COOKIE['Estado'] = 0;
    // }


    
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

    echo "<div class='contenidoTabla'>";
    while ($fila = $MyBBDD->extraerRegistro()) {
        echo "<p>" . $fila['nombre_empleado'] . " " .
            $fila['apellidos_empleado'] . "<a>Ver Historial</a>" . "</pr>";
    }
    echo "</div>"
    ?>

    <h3 class="cabecera"> Herramientas</h3>

    <?php
 echo '<h1>ID DE LA EMPRESA (idempresa): ' . $id_empresa . '</h1><br>';
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
            "<td><button name='statusLibre' class='btnLibre'>✔️</button></td>
            <td><button name='statusOcup' class='btnOcupado'>🚫</button></td>
            <td><button name='statusEstro' class='btnEstropeado'>🛠️</button></td></tr>";
    }
    echo "</table>";

    /*
    if (isset($_POST['statusLibre'])) {
        
        $sql = "UPDATE utiles 
            SET estado_util = 'libre' 
            WHERE id_util = $id_util
            AND id_empresa = $id_empresa;
        "
        $MyBBDD->consulta($sql);
    }
    
    if (isset($_POST['statusOcup'])) {
        
        $sql = "UPDATE utiles 
            SET estado_util = 'ocupado' 
            WHERE id_util = $id_util
            AND id_empresa = $id_empresa;
        "
        $MyBBDD->consulta($sql);
    }
    if (isset($_POST['statusEstro'])) {
        
        $sql = "UPDATE utiles 
            SET estado_util = 'ocupado' 
            WHERE id_util = $id_util
            AND id_empresa = $id_empresa;
        "
        $MyBBDD->consulta($sql);
    }
    
    */
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

    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>

    <script src="main.js"></script>


    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>


</body>

</html>