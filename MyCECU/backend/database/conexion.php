<?php
/*---------------------------------------------------------
  CONEXIÓN PDO — cambia los valores por los de tu servidor
---------------------------------------------------------*/
$host = 'localhost';
$db   = 'tu_base';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lanza excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // devuelve arreglos asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // usa preparadas nativas
];

try {
    $conexion = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // En producción NO muestres esto tal cual
    exit("Error de conexión: " . $e->getMessage());
}
?>