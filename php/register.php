<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro</title>

</head>

<body>

    <h1>ALMA-ZEN</h1>


    <!-- RECOGEMOS LOS DATOS PARA Registrarse -->

    
    <form method="POST" action="index.php" class="formulario">
        Usuario: <input type="text" required name="user" placeholder="Usuario*">
        E-mail<input type="text" required name="email" placeholder="e-mail*">
        Contraseña<input type="password" required name="password" placeholder="Contraseña*">
        Empresa<input type="text" required name="empresa" placeholder="Empresa*">
        Rol<input type="text" required name="rol" placeholder="Rol*">
        <input type="submit" name="btn-reg" value="Enviar">
    </form>

    <br>
    <footer>Juan Antonio Amil y Antonio Marín</footer>


</body>

</html>