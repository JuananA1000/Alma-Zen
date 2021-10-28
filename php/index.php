<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
</head>

<body>
    <h1>ALMA-ZEN</h1>

    <p>Inicio Sesión</p>



    <?php
    include("conect_class.php");

    if (isset($_POST['nombre_empresa'])) {
        $nombre_empresa = $_POST['nombre_empresa'];
        $sql = "INSERT INTO empresas (nombre_empresa) VALUES ('$nombre_empresa');";
        $MyBBDD->consulta($sql);
    }

    $sql = "SELECT * FROM empresas;";
    $MyBBDD->consulta($sql);

    /*while ($fila = $MyBBDD->extraerRegistro()) {
        $idTema = $fila['idTema'];
        echo "<a href='comentarios.php?idTema=$idTema'>" . $fila['nombre'] . "</a> <br>";
    }*/

    while ($fila = $MyBBDD->extraerRegistro()) {
        $id_empresa = $fila['id_empresa']; // id_empresa de la empresa
        echo "Empresa: <a href='empresas.php?id_empresa=$id_empresa'>".$fila['nombre_empresa']. "</a><br>";
    }
    ?>

    <form method="POST">
        <p>Nombre Empresa:<input type="text" name="nombre_empresa" />
            <input type="submit" value="Insertar">
        </p>

    </form>

    <footer>Juan Antonio Amil y Antonio Marín</footer>
</body>

</html>