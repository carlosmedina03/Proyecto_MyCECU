<?php
// conexión PDO segura
$host = 'localhost';
$dbname = 'mycecu';
$user = 'root'; // o el usuario que tengas
$pass = '';     // contraseña

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
