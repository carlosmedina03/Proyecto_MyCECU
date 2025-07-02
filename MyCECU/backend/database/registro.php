<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$nacimiento = $_POST['nacimiento'];
$curp = $_POST['curp'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$domicilio = $_POST['domicilio'];
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$nivestudios = $_POST['nivestudios'];
$institucion = $_POST['institucion'];
$especialidad = $_POST['especialidad'];
$cedula = $_POST['cedula'];

$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparamos la consulta con todos los campos
$sql = "INSERT INTO usuarios (
    nombre, paterno, materno, nacimiento, curp, telefono, correo, contraseña,
    domicilio, estado, ciudad, nivestudios, institucion, especialidad, cedula
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

// Ejecutamos la consulta con los datos
$exito = $stmt->execute([
    $nombre, $paterno, $materno, $nacimiento, $curp, $telefono, $correo, $contrasena_hash,
    $domicilio, $estado, $ciudad, $nivestudios, $institucion, $especialidad, $cedula
]);

if ($exito) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar usuario";
}
?>
