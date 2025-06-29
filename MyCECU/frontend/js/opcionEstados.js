fetch('../json/mexico.json')
    .then(response => response.json())
    .then(data => {
    const eSel = document.getElementById('estado');
    const cSel = document.getElementById('ciudad');
    Object.keys(data).forEach(est => {
        const o = document.createElement('option');
        o.value = est;
        o.textContent = est;
        eSel.append(o);
    });
    eSel.addEventListener('change', () => {
        data[eSel.value].forEach(ciu => {
        const o = document.createElement('option');
        o.value = ciu;
        o.textContent = ciu;
        cSel.append(o);
        });
    });
    });