<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();
if (!isset($_SESSION['estado'])) { //a estado le asignamos la id del usuario
    $_SESSION['estado'] = 0;
}else{
    $_SESSION['estado'] =  $_SESSION['id'];
}
echo  $_SESSION['estado'];
echo  $_SESSION['id'];

 //      --- SI PULSAMOS EL BOTON INICIAR SESION
 
 if (isset($_POST['btn-ini'])) { //btn-ini viene de login.php

    $user = $_POST["user"];
    $password = $_POST["password"];

 }

//  RECIBIMOS LOS DATOS -- DE REGISTRO -- Y LOS METEMOS EN LA BBDD
if (
    isset($_POST["btn-reg"])
) {
    $empresa = $_POST["empresa"];
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];


    //      ---- INSERTAMOS LOS DATOS   ---
    $inserta = "INSERT INTO usuarios (id_empresa, user, email, password, rol) VALUES ('$empresa', '$user','$email','$password', '$rol');";
    echo $inserta;
    $MyBBDD->consulta($inserta);

    //      ---- SACAMOS LA ID DEL USUARIO   ---
    // ------------ ESTO NOS SERVIRÁ PARA NAVEGAR POR LA PÁGINA REGISTRADOS
    $consulta = "SELECT id_user FROM usuarios WHERE user='$user' AND password='$password';";
    $MyBBDD->consulta($consulta);
    $fila = $MyBBDD->extraerRegistro(); //nos devuelve los datos de la sentencia
    $_SESSION['estado'] = $fila['id_user'];
    $_SESSION['id'] = $fila['id_user'];
    echo   '<br><h1>Registrados con id nº ' . $_SESSION['estado'] . '</h1><br>';
}

// estado = 0 -> sin logear
// estado = 1 O DISTINTO DE 0 ->  logeado


//      ---- SACAMOS LA ID DE la empresa   ---
$id_usuario = $_SESSION['estado'];
$sql = "SELECT id_empresa FROM usuarios
    WHERE id_user = $id_usuario;
";
$MyBBDD->consulta($sql);

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
<form method="post" action="login.php">
    <input type="submit" value="Iniciar Sesión" name="inicia-sesion">
</form>

<!-- Imprimimos el boton de cerrar sesión sesion -->
<form method="post" action="login.php">
    <input type="submit" value="Cerrar Sesión" name="cierra-sesion">
</form>


<body>
    <h1>ALMA-ZEN</h1>
    
    <!-- <p>Inicio Sesión</p> -->

    <?php

    // CIERRA LA SESION
if (isset($_POST['cierra-sesion'])) {
    $_SESSION['estado'] = 0;
}


$id_empresa = $_SESSION['estado'];
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
            $fila['apellidos_empleado'] ."<a>Ver Historial</a>". "</pr>";
    }
    echo "</div>"
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
    // $id_empresa = $_SESSION['estado'];
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
            "<td><button class='btnLibre'>✔️</button></td>
            <td><button class='btnOcupado'>🚫</button></td>
            <td><button class='btnEstropeado'>🛠️</button></td></tr>";
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

    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>

    <script src="main.js"></script>
   

    <footer>Juan Antonio Amil y Antonio Marín, 2021</footer>


</body>

</html>