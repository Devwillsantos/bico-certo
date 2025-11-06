const aumentarZoom = document.getElementById('aumentarZoom');
const abaixarZoom  = document.getElementById('abaixarZoom');
const aumentarZoomDM = document.getElementById('aumentarZoomDM');
const abaixarZoomDM = document.getElementById('abaixarZoomDM');
const containerDireito = document.getElementById('container-direito');
const modalBox = document.querySelector('.modal-box');

aumentarZoom.addEventListener('click', () => {
	containerDireito.style.zoom = '125%'; // Zoom in by 125%
	modalBox.style.zoom = '125%';
});
  
abaixarZoom.addEventListener('click', () => {
	containerDireito.style.zoom = '100%'; // Zoom back to 100% (normal size)
	modalBox.style.zoom = '100%';
});

aumentarZoomDM.addEventListener('click', () => {
	containerDireito.style.zoom = '125%'; // Zoom in by 125%
	modalBox.style.zoom = '125%';
});

abaixarZoomDM.addEventListener('click', () => {
	containerDireito.style.zoom = '100%'; // Zoom back to 100% (normal size)
	modalBox.style.zoom = '100%';
});