<?php
include 'conect_class.php'; // MUY IMPORTANTE.
session_start();
//Recogemos las variables de sesión
$id_empresa = $_SESSION["id_empresa"];
$nombre_empresa = $_SESSION["nombre_empresa"];


echo '<link rel="stylesheet" type="text/css" href="style.css" />'; //LLAMAMOS AL CSS

//DIBUJAMOS EL NAVBAR

echo '<div class="topnav">
<a  href="index.php">Home</a>
<a href="empleados.php">Empleados</a>
<a class="active" href="herramientas.php">Herramientas</a>
<a href="#about">About</a>
<p class="nombre_empresa">'. strtoupper($nombre_empresa ).'</p>
</div>';



 echo '<h3 class="cabecera">Herramientas</h3>';
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

if (isset($_POST['tick'])) {
    $id_util = $_POST['id_util'];
     
    $sql = "    UPDATE utiles
                SET estado_util = 'ocupado'
                WHERE id_util = $id_util;
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
    echo "<tr id='fila'><td>" . $fila['marca_util'] . "</td>" .
        "<td>" . $fila['id_util'] . "</td>" .
        "<td>" . $fila['modelo_util'] . "</td>" .
        "<td>" .   $fila['categoria_util'] . "</td>" .
        "<td>" .    $fila['herramienta_vehiculo'] . "</td>" .
        "<td>" . $fila['estado_util'] . "</td>" .
        "<td><input type='submit' value='✔️' name='tick'></td></tr>";
    // <td><button name='statusOcup' class='btnOcupado'>🚫</button></td>
    // <td><button name='statusEstro' class='btnEstropeado'>🛠️</button></td></tr>";
}
echo "</table>";