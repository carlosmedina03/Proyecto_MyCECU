<?php
require_once 'conexion.php';

// Obtener por id o curp
$id   = $_GET['id'] ?? null;
$curp = $_GET['curp'] ?? null;

if (!$id && !$curp) {
    exit('⚠️ No se proporcionó ID ni CURP del paciente.');
}

// Buscar paciente por ID o CURP
if ($id) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
} else {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE curp = ?");
    $stmt->execute([$curp]);
}

$paciente = $stmt->fetch();

if (!$paciente) {
    exit('🚫 Paciente no encontrado');
}

$edad = date_diff(date_create($paciente['nacimiento']), new DateTime())->y;

// Ruta de foto personalizada: /assets/fotos/CURP.jpg
$fotoRuta = "../assets/fotos/" . $paciente['curp'] . ".jpg";
$fotoFinal = file_exists($fotoRuta) ? $fotoRuta : "../assets/placeholder-sin-foto.png";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Expediente de <?= htmlspecialchars($paciente['nombre']) ?></title>
    <link rel="stylesheet" href="../css/estilos-globales.css">
    <link rel="stylesheet" href="../css/estilos-expediente.css">
</head>
<body>
    <main>
        <h1>EXPEDIENTE CLÍNICO</h1>

        <section>
            <h2>DATOS GENERALES</h2>
            <article class="datos-generales">
                <div class="foto-perfil">
                    <img src="<?= $fotoFinal ?>" alt="Foto del paciente">
                </div>
                <div><p>Nombre: <?= $paciente['nombre'] . ' ' . $paciente['paterno'] . ' ' . $paciente['materno'] ?></p></div>
                <div><p>CURP: <?= $paciente['curp'] ?></p></div>
                <div><p>Fecha de nacimiento: <?= $paciente['nacimiento'] ?></p></div>
                <div><p>Edad: <?= $edad ?> años</p></div>
                <div><p>Grupo sanguíneo: <?= $paciente['sanguineo'] ?></p></div>
                <div><p>Sexo: <?= $paciente['genero'] ?></p></div>
                <div><p>Peso: <?= $paciente['peso'] ?> kg</p></div>
                <div><p>Estatura: <?= $paciente['estatura'] ?> m</p></div>
            </article>
        </section>

        <section>
            <h2>DATOS DE LOCALIZACIÓN</h2>
            <article class="datos-localizacion">
                <div><p>Domicilio: <?= $paciente['domicilio'] ?></p></div>
                <div><p>Municipio: <?= $paciente['ciudad'] ?></p></div>
                <div><p>Teléfono personal: <?= $paciente['telefono'] ?></p></div>
                <div><p>Estado: <?= $paciente['estado'] ?></p></div>
                <div><p>Teléfono de emergencia: <?= $paciente['telemergencia'] ?></p></div>
            </article>
        </section>

        <section>
            <h2>ANTECEDENTES MÉDICOS</h2>
            <article class="antecedentes-medicos">
                <div><p>Antecedentes familiares relevantes: No registrado</p></div>
                <div><p>Discapacidades y enfermedades crónicas: No registrado</p></div>
                <div><p>Reacciones alérgicas: No registrado</p></div>
            </article>
        </section>

        <section>
            <h2>ESTUDIOS DE LABORATORIO E IMAGENOLOGÍA</h2>
            <article class="estudios-laboratorio">
                <p>No disponibles</p>
            </article>
        </section>

        <section>
            <h2>RECETAS DE CONSULTAS CLÍNICAS</h2>
            <article class="recetas-clinicas">
                <p>No disponibles</p>
            </article>
        </section>
    </main>
</body>
</html>
