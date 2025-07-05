<?php
require_once 'conexion.php';

/*--------------------------
  1. Validar método y datos
--------------------------*/
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

/* Evita notices si algún campo viene vacío */
$campos  = ['nombre','paterno','materno','nacimiento','curp','telefono',
            'correo','contrasena','domicilio','estado','ciudad',
            'nivestudios','institucion','especialidad','cedula'];

foreach ($campos as $c) {
    $$c = $_POST[$c] ?? null;              // variables variables
}

/*--------------------------
  2. Hash de la contraseña
--------------------------*/
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

/*--------------------------
  3. Insert preparado
--------------------------*/
$sql = "INSERT INTO usuarios (
            nombre, paterno, materno, nacimiento, curp, telefono, correo,
            contraseña, domicilio, estado, ciudad, nivestudios, institucion,
            especialidad, cedula
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conexion->prepare($sql);

try {
    $stmt->execute([
        $nombre, $paterno, $materno, $nacimiento, $curp, $telefono, $correo,
        $contrasena_hash, $domicilio, $estado, $ciudad, $nivestudios,
        $institucion, $especialidad, $cedula
    ]);
    echo "✅ Registro exitoso";
} catch (PDOException $e) {
    // Si la columna correo o curp es UNIQUE, avisa al usuario
    if ($e->errorInfo[1] == 1062) {  // código MySQL para duplicado
        echo "⚠️ El correo o la CURP ya están registrados";
    } else {
        echo "❌ Error al registrar: " . $e->getMessage();
    }
}
?>
