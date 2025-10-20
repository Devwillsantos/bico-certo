const contratante     = document.getElementById('contratante');
const prestador       = document.getElementById('prestador');
const extraColumn     = document.getElementById('coluna5');
const prestadorOpcoes = document.getElementById('prestador-opcoes');

contratante.addEventListener('change', function() {
    if (this.checked) {
        extraColumn.style.display = 'none';
        prestador.checked = false;
        prestadorOpcoes.value = "";
    }
});

prestador.addEventListener('change', function() {
    if (this.checked) {
        extraColumn.style.display = 'block';
        contratante.checked = false;
    }
});