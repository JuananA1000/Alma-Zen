<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    
        <!-- RECOGEMOS LOS DATOS PARA Registrarse -->

<form method="POST" action="index.php">
        <input type="text" required name="user" placeholder="Usuario*">
        <input type="text" required name="email" placeholder="e-mail*">
        <input type="password" required name="password" placeholder="Contraseña*">
        <input type="text" required name="empresa" placeholder="Empresa*">
        <input type="text" required name="rol" placeholder="Rol*">
        <!-- ~~~~~~~~~~~ DE MOMENTO, METEMOS LA ID DE LA EMPRESA ~~~~~~~~~~~~4 -->
        <!-- A ver como tratamos la empresa. Si pidiendo la ID en el formulario, o haciendo un select de la id 
             where nombre = nombre -->

             <!-- OTRA OPCIÓN es CARGARSE EL FORMULARIO DE REGISTRO y que lo haga un admin desde otro sitio -->
       
        <input type="submit" name="btn-reg" value="Enviar">
    </form>





    
</body>

</html>