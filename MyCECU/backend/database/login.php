<?php
include 'conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE Correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$correo]);

$usuario = $stmt->fetch();

if ($usuario && password_verify($contrasena, $usuario['contraseña'])) {
    echo "Inicio de sesión exitoso";
} else {
    echo "Correo o contraseña incorrectos";
}
?>