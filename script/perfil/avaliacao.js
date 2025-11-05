const modal = document.getElementById('modalAvaliacao');
const btnAbrir = document.getElementById('abrirModal');
const btnFechar = document.getElementById('fecharModal');
const estrelas = document.querySelectorAll('.estrela');
const notaInput = document.getElementById('nota');

//abrir e fechar Modal
btnAbrir.onclick = () => modal.style.display = 'flex';
btnFechar.onclick = () => modal.style.display = 'none';
window.onclick = (e) => { if (e.target == modal) modal.style.display = 'none';}

//Estrelas
estrelas.forEach((estrela, index) => {
    estrela.addEventListener('click', () => {
        notaInput.value = index + 1;
        estrelas.forEach((e,i) => {
            e.classList.toggle('ativa', i <= index);
        });
    });
});