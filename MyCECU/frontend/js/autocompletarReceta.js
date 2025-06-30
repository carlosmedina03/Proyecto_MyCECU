document.addEventListener("DOMContentLoaded", () => {
    // Simulación de datos desde la base de datos
    const datos = {
        doctor: {
            nombre: "Marko Adahir",
            apellidoPaterno: "Cabrales",
            apellidoMaterno: "Rodríguez",
            especialidad: "Cardiología",
            cedula: "1234567",
            correo: "marko@medico.com",
            telefono: "6691234567"
        },
        paciente: {
            nombre: "Carlos Santiago",
            apellidoPaterno: "Sanchez",
            apellidoMaterno: "Robles",
            edad: 45,
            municipio: "Mazatlán",
            estado: "Sinaloa"
        }
    };
    // Insertar número de consulta dinámico
    const numeroConsulta = `CONS-${Date.now().toString().slice(-12)}`;
    document.querySelector(".consulta-numero").textContent = `No. consulta: ${numeroConsulta}`;
    document.getElementById("form-receta").dataset.numeroConsulta = numeroConsulta;
    // Insertar datos en los campos readonly
    document.getElementById("nombre-doctor").value = datos.doctor.nombre;
    document.getElementById("apellido-paterno-doctor").value = datos.doctor.apellidoPaterno;
    document.getElementById("apellido-materno-doctor").value = datos.doctor.apellidoMaterno;
    document.getElementById("especialidad-medica").value = datos.doctor.especialidad;
    document.getElementById("cedula-profesional").value = datos.doctor.cedula;
    document.getElementById("correo-doctor").value = datos.doctor.correo;
    document.getElementById("telefono-doctor").value = datos.doctor.telefono;

    document.getElementById("nombre-paciente").value = datos.paciente.nombre;
    document.getElementById("apellido-paterno-paciente").value = datos.paciente.apellidoPaterno;
    document.getElementById("apellido-materno-paciente").value = datos.paciente.apellidoMaterno;
    document.getElementById("edad-paciente").value = datos.paciente.edad;
    document.getElementById("municipio-emision").value = datos.paciente.municipio;
    document.getElementById("estado-emision").value = datos.paciente.estado;
});
