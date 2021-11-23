<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    
<form method="POST" action="index.php">
        <input type="text" required name="user" placeholder="Usuario*">
        <input type="password" required name="password" placeholder="ContraseÃ±a*">
        <input type="text" required name="bio" placeholder="BiografÃ­a*">
        <input type="date" required name="fech" placeholder="Fecha de nacimiento*">
        <input type="text" required name="nacion" placeholder="Nacionalidad*">
        <select name="sex">
            <option value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
            <option value="NC">No contestar</option>
        </select>
        <br>
        Aceptar términos y condiciones:
        <input type="checkbox" required name="term">
        <br>
        <br>
        <input type="submit" name="btn-enviar" value="Enviar">
    </form>





    
</body>

</html>