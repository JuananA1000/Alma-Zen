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
<!-- PRUEBA 19.48 -->
    <?php
    include("conect_class.php");

    if (isset($_POST['Nombre_Empresa'])) {
        $Nombre_Empresa = $_POST['Nombre_Empresa'];
        $sql = "INSERT INTO empresas (Nombre_Empresa) VALUES ('$Nombre_Empresa');";
        $MyBBDD->consulta($sql);
    }

    $sql = "SELECT * FROM empresas;";
    $MyBBDD->consulta($sql);

    /*while ($fila = $MyBBDD->extraerRegistro()) {
        $idTema = $fila['idTema'];
        echo "<a href='comentarios.php?idTema=$idTema'>" . $fila['nombre'] . "</a> <br>";
    }*/

    while ($fila = $MyBBDD->extraerRegistro()) {
        $id = $fila['id']; // id de la empresa
        echo "Empresa: <a href='empresas.php?id=$id'>".$fila['Nombre_Empresa']. "</a><br>";
    }
    ?>

    <form method="POST">
        <p>Nombre Empresa:<input type="text" name="Nombre_Empresa" />
            <input type="submit" value="Insertar">
        </p>

    </form>

    <footer>Juan Antonio Amil y Antonio Marín</footer>
</body>

</html>