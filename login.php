<?php
// Iniciamos la sesión para poder guardar el usuario que se conecta
session_start();

// Recogemos lo que se ha escrito en el formulario
$usuario = $_POST["usuario"];
$password = $_POST["password"];

// Leemos el archivo usuarios.json y lo pasamos a un array
$contenido = file_get_contents("usuarios.json");
$usuarios = json_decode($contenido, true);

// Variable para saber si hemos encontrado el usuario
$encontrado = false;

// Recorremos todos los usuarios del archivo
foreach ($usuarios as $u) {
    // Si el usuario y la contraseña coinciden
    if ($u["username"] == $usuario && $u["password"] == $password) {
        $encontrado = true;

        // Guardamos los datos del usuario en la sesión
        $_SESSION["usuario"] = $u["username"];
        $_SESSION["nombre"] = $u["nombre"];
        $_SESSION["avatar"] = $u["avatar"];
        $_SESSION["rol"] = $u["rol"];
    }
}

if ($encontrado) {
    // Si es correcto volvemos a la página de inicio
    header("Location: index.html");
} else {
    // Si no es correcto mostramos un mensaje de error
    echo "<p>Usuario o contraseña incorrectos</p>";
    echo "<p><a href='index.html'>Volver al inicio</a></p>";
}
?>
