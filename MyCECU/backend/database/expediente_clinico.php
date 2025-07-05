<?php
require_once 'conexion.php';

/*--------------------------------------------
  Recibimos id o curp por GET: ?id=1  | ?curp=XXX
--------------------------------------------*/
$id   = $_GET['id']   ?? null;
$curp = $_GET['curp'] ?? null;

if (!$id && !$curp) {
    exit('Falta parámetro id o curp');
}

/*--------------------------------------------
  Construimos la consulta según lo recibido
--------------------------------------------*/
if ($id) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
} else {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE curp = ?");
    $stmt->execute([$curp]);
}

$paciente = $stmt->fetch();

if (!$paciente) {
    exit('Paciente no encontrado');
}

/*--------------------------------------------
  Helper para escapar HTML y evitar XSS
--------------------------------------------*/
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Expediente de <?= e($paciente['nombre']) ?></title>
    <link rel="stylesheet" href="css/estilos-globales.css">
    <link rel="stylesheet" href="css/estilos-expediente.css">
</head>
<body>
<main>
    <h1>EXPEDIENTE CLÍNICO</h1>

    <!-- DATOS GENERALES -->
    <section>
        <h2>Datos generales</h2>
        <article class="datos-generales">
            <div><p>Nombre: <strong><?= e($paciente['nombre']) . ' ' .
                                         e($paciente['paterno']) . ' ' .
                                         e($paciente['materno']) ?></strong></p></div>

            <div><p>CURP: <strong><?= e($paciente['curp']) ?></strong></p></div>
            <div><p>Fecha de nacimiento: <strong><?= e($paciente['nacimiento']) ?></strong></p></div>

            <?php
                // Calcular edad rápido en PHP
                $edad = $paciente['nacimiento']
                    ? date_diff(date_create($paciente['nacimiento']), new DateTime('today'))->y
                    : '';
            ?>
            <div><p>Edad: <strong><?= e($edad) ?></strong></p></div>
            <!-- Agrega más campos según tu tabla -->
        </article>
    </section>

    <!-- Puedes continuar las demás secciones igual que tu HTML original -->
</main>
</body>
</html>
