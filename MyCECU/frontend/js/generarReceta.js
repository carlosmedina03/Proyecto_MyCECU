function generarPDF() {
    const form = document.getElementById("form-receta");
    if (!form.checkValidity()) {
        form.reportValidity(); // Muestra errores en campos
        return;
    }

    const numeroConsulta = form.dataset.numeroConsulta || "#############";

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let y = 20;
    doc.setFont("Helvetica", "bold");
    doc.setFontSize(16);
    doc.text("Receta Médica", 105, y, { align: "center" });

    y += 10;
    doc.setFontSize(10);
    doc.setFont("Helvetica", "normal");
    doc.text(`No. Consulta: ${numeroConsulta}`, 14, y);

    y += 10;

    const doctor = {
        nombre: document.getElementById("nombre-doctor").value,
        apPaterno: document.getElementById("apellido-paterno-doctor").value,
        apMaterno: document.getElementById("apellido-materno-doctor").value,
        especialidad: document.getElementById("especialidad-medica").value,
        cedula: document.getElementById("cedula-profesional").value,
        correo: document.getElementById("correo-doctor").value,
        telefono: document.getElementById("telefono-doctor").value
    };

    const paciente = {
        nombre: document.getElementById("nombre-paciente").value,
        apPaterno: document.getElementById("apellido-paterno-paciente").value,
        apMaterno: document.getElementById("apellido-materno-paciente").value,
        edad: document.getElementById("edad-paciente").value,
        municipio: document.getElementById("municipio-emision").value,
        estado: document.getElementById("estado-emision").value
    };

    const consulta = {
        fecha: document.getElementById("fecha-consulta").value,
        hora: document.getElementById("hora-consulta").value,
        diagnostico: document.getElementById("diagnostico").value,
        medicamento: document.getElementById("medicamento").value,
        adicional: document.getElementById("info-adicional").value
    };

    doc.setFontSize(12);
    doc.setFont("Helvetica", "normal");
    doc.text(`Fecha de la consulta: ${consulta.fecha}`, 14, y);
    y += 6;
    doc.text(`Hora de la consulta: ${consulta.hora}`, 14, y);

    y += 10;
    doc.setFont("Helvetica", "bold");
    doc.text("Datos del Doctor:", 14, y);
    y += 6;
    doc.setFont("Helvetica", "normal");
    doc.text(`Nombre: ${doctor.nombre} ${doctor.apPaterno} ${doctor.apMaterno}`, 14, y);
    y += 6;
    doc.text(`Especialidad: ${doctor.especialidad}`, 14, y);
    y += 6;
    doc.text(`Cédula Profesional: ${doctor.cedula}`, 14, y);
    y += 6;
    doc.text(`Correo: ${doctor.correo}`, 14, y);
    y += 6;
    doc.text(`Teléfono: ${doctor.telefono}`, 14, y);

    y += 10;
    doc.setFont("Helvetica", "bold");
    doc.text("Datos del Paciente:", 14, y);
    y += 6;
    doc.setFont("Helvetica", "normal");
    doc.text(`Nombre: ${paciente.nombre} ${paciente.apPaterno} ${paciente.apMaterno}`, 14, y);
    y += 6;
    doc.text(`Edad: ${paciente.edad} años`, 14, y);
    y += 6;
    doc.text(`Municipio: ${paciente.municipio}`, 14, y);
    y += 6;
    doc.text(`Estado: ${paciente.estado}`, 14, y);

    y += 10;
    doc.setFont("Helvetica", "bold");
    doc.text("Diagnóstico:", 14, y);
    y += 6;
    doc.setFont("Helvetica", "normal");
    const splitDiagnostico = doc.splitTextToSize(consulta.diagnostico, 180);
    doc.text(splitDiagnostico, 14, y);
    y += splitDiagnostico.length * 6 + 6;

    doc.setFont("Helvetica", "bold");
    doc.text("Medicamento y forma de uso:", 14, y);
    y += 6;
    doc.setFont("Helvetica", "normal");
    const splitMedicamento = doc.splitTextToSize(consulta.medicamento, 180);
    doc.text(splitMedicamento, 14, y);
    y += splitMedicamento.length * 6 + 6;

    doc.setFont("Helvetica", "bold");
    doc.text("Información adicional:", 14, y);
    y += 6;
    doc.setFont("Helvetica", "normal");
    const splitAdicional = doc.splitTextToSize(consulta.adicional, 180);
    doc.text(splitAdicional, 14, y);
    y += splitAdicional.length * 6;

    doc.save("receta-medica.pdf");
}
