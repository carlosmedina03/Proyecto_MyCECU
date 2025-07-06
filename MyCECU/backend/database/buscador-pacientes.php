<?php
require_once 'conexion.php';

/*----------------------------------------------------------
  1. Recibimos el criterio de búsqueda por GET
----------------------------------------------------------*/
$q      = trim($_GET['q']      ?? '');
$campo  = $_GET['campo']       ?? 'curp';   // curp | correo | nombre
$campos_validos = ['curp', 'correo', 'nombre'];

if (!in_array($campo, $campos_validos)) {
    $campo = 'curp';
}

/*----------------------------------------------------------
  2. Armamos la consulta
     - Si hay término: SELECT ... WHERE campo LIKE ?
     - Sin término:    SELECT ... LIMIT 20
----------------------------------------------------------*/
if ($q !== '') {
    $sql  = "SELECT id, nombre, paterno, materno, curp, correo
             FROM usuarios
             WHERE $campo LIKE ?
             ORDER BY nombre
             LIMIT 30";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['%' . $q . '%']);
} else {
    $sql  = "SELECT id, nombre, paterno, materno, curp, correo
             FROM usuarios
             ORDER BY id DESC
             LIMIT 20";
    $stmt = $conexion->query($sql);
}

$usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador de pacientes</title>
    <link rel="stylesheet" href="../css/estilos-globales.css">
    <link rel="stylesheet" href="../css/estilos-expediente.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: .6rem; border-bottom: 1px solid #ccc; text-align: left; }
        tr:hover { background:#f2f2f2; cursor:pointer; }
    </style>
</head>
<body>
<header>
    <!-- usa tu mismo nav si quieres -->
</header>

<main>
    <h1>BUSCADOR DE PACIENTES</h1>

    <form method="get">
        <input  type="text"   name="q"     placeholder="Buscar..." value="<?= htmlspecialchars($q) ?>" required>
        <select name="campo">
            <option value="curp"   <?= $campo==='curp'   ? 'selected' : '' ?>>CURP</option>
            <option value="correo" <?= $campo==='correo' ? 'selected' : '' ?>>Correo</option>
            <option value="nombre" <?= $campo==='nombre' ? 'selected' : '' ?>>Nombre / Apellido</option>
        </select>
        <button type="submit">Buscar</button>
        <?php if ($q !== ''): ?>
             <a href="buscador-pacientes.php">(Limpiar)</a>
        <?php endif; ?>
    </form>

    <?php if (!$usuarios): ?>
        <p>No se encontraron resultados.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre completo</th>
                    <th>CURP</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr onclick="window.location='expediente-clinico.php?id=<?= $u['id'] ?>'">
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars("{$u['nombre']} {$u['paterno']} {$u['materno']}") ?></td>
                    <td><?= htmlspecialchars($u['curp'])   ?></td>
                    <td><?= htmlspecialchars($u['correo']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p style="margin-top:.5rem"><?= count($usuarios) ?> resultado(s).</p>
    <?php endif; ?>
</main>
</body>
</html>
