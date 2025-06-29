document.addEventListener("DOMContentLoaded", function () {
    // Validacion para enfermedad cronica
    const radioEnfSi = document.getElementById("enfermedad-cronica-si");
    const radioEnfNo = document.getElementById("enfermedad-cronica-no");
    const inputEnfDetalles = document.getElementById("detalles-enfermedad");

    function actualizarCampoEnfermedad() {
        if (radioEnfSi.checked) {
            inputEnfDetalles.required = true;
            inputEnfDetalles.disabled = false;
        } else if (radioEnfNo.checked) {
            inputEnfDetalles.required = false;
            inputEnfDetalles.disabled = true;
            inputEnfDetalles.value = "";
        }
    }

    radioEnfSi.addEventListener("change", actualizarCampoEnfermedad);
    radioEnfNo.addEventListener("change", actualizarCampoEnfermedad);
    actualizarCampoEnfermedad();

    // Validacion para alergias
    const radioAlergiaSi = document.getElementById("alergia-si");
    const radioAlergiaNo = document.getElementById("alergia-no");
    const inputAlergiaDetalles = document.getElementById("detalles-alergia");

    function actualizarCampoAlergia() {
        if (radioAlergiaSi.checked) {
            inputAlergiaDetalles.required = true;
            inputAlergiaDetalles.disabled = false;
        } else if (radioAlergiaNo.checked) {
            inputAlergiaDetalles.required = false;
            inputAlergiaDetalles.disabled = true;
            inputAlergiaDetalles.value = "";
        }
    }

    radioAlergiaSi.addEventListener("change", actualizarCampoAlergia);
    radioAlergiaNo.addEventListener("change", actualizarCampoAlergia);
    actualizarCampoAlergia();
});
