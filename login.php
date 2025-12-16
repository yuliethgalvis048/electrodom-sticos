<?php
session_start();
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contraseña, $usuario['contraseña'])) {

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];

            echo "Inicio de sesión exitoso. Bienvenido " . $usuario['nombre'];
            echo "Registro exitoso. <a href='../servicios.html'>Ir a la pagina principal</a>";
        } else {
            echo "Contraseña incorrecta.";
        }

    } else {
        echo "No existe un usuario con ese correo.";
    }

 
}

?>