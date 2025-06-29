// selectorBuscador.js
const pacientes = [
    //EJEMPLOS DE PRUEBA!!!!!!
  { nombre_completo: 'Carlos Antonio Rivera Medina', fecha_nacimiento: '1985-08-27', curp: 'MOGM920215HDFNZN07', foto_url: '../assets/foto-carlos.png' },
  { nombre_completo: 'Carlos Antonio Rivera Medina', fecha_nacimiento: '1970-01-15', curp: 'HOHJ700115HDFNTN08', foto_url: '' },
  { nombre_completo: 'Luis Guillermo Ramos Díaz',    fecha_nacimiento: '1980-05-25', curp: 'RAML800115HDFNTN09', foto_url: '../assets/foto-luis.png' }
];

function normalizeText(str) {
  return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
}

const criterio = document.getElementById('criterio');
const busqueda = document.getElementById('busqueda');
const resultado = document.querySelector('.resultado');

criterio.addEventListener('change', () => {
  if (criterio.value === 'fecha') {
    busqueda.type = 'date';
    busqueda.placeholder = 'Seleccione una fecha';
  } else {
    busqueda.type = 'search';
    busqueda.placeholder = 'Escriba aquí su búsqueda';
  }
});

busqueda.addEventListener('keydown', e => {
  if (e.key !== 'Enter') return;
  e.preventDefault();
  const valorRaw = busqueda.value.trim();
  if (!valorRaw) return;

  let matches = [];

  if (criterio.value === 'nombre') {
    const searchWords = normalizeText(valorRaw).split(/\s+/).filter(w => w);
    if (searchWords.length >= 2) {
      matches = pacientes.filter(p => {
        const nameWords = normalizeText(p.nombre_completo).split(/\s+/);
        return searchWords.every(sw => nameWords.includes(sw));
      });
    }
  } else {
    matches = pacientes.filter(p => p.fecha_nacimiento === valorRaw);
  }

  resultado.innerHTML = '';

  if (matches.length) {
    matches.forEach(p => {
    const imgSrc = p.foto_url || '../assets/placeholder-sin-foto.png';
    const tarjeta = document.createElement('div');
    tarjeta.className = 'tarjeta';
    tarjeta.innerHTML = `
        <img src="${imgSrc}" alt="Foto de ${p.nombre_completo}">
        <div class="informacion">
        <h3>${p.nombre_completo}</h3>
        <p>Fecha de nacimiento: ${p.fecha_nacimiento}</p>
        <p>CURP: ${p.curp}</p>
        </div>
        <div class="botones">
        <button onclick="window.location.href='consulta-clinica.html'">REALIZAR CONSULTA</button>
        <button onclick="window.location.href='expediente-clinico-panel-doctor.html'">VISUALIZAR EXPEDIENTE</button>
        </div>
    `;
  resultado.appendChild(tarjeta);
});

  } else {
    const msg = document.createElement('p');
    msg.style.padding = '20px';
    msg.style.color   = '#fff';
    msg.textContent   = `No se encontró ningún paciente que coincida con "${valorRaw}".`;
    resultado.appendChild(msg);
  }

  resultado.classList.add('visible');
});
