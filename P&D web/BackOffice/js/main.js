//modal agregar
const abrirModal = document.getElementById('abrirModal');
const modalAgregar = document.getElementById('modalAgregar');
const atras = document.getElementById('atras');

abrirModal.addEventListener('click', () => {
  modalAgregar.classList.add('show');  
});

atras.addEventListener('click', () => {
  modalAgregar.classList.remove('show');
});

//modal agregar horarios
const abrirModalHorarios = document.getElementById('abrirModalHorarios');
const modalAgregarHorarios = document.getElementById('modalAgregarHorarios');
const salirHorarios = document.getElementById('salirHorarios');

abrirModalHorarios.addEventListener('click', () => {
  modalAgregarHorarios.classList.add('showHorarios');  
  modalAgregar.classList.remove('show');
});

salirHorarios.addEventListener('click', () => {
  modalAgregarHorarios.classList.remove('showHorarios');
  modalAgregar.classList.add('show');  
});

//modal agregar paradas
const abrirModalParadas = document.getElementById('abrirModalParadas');
const modalAgregarParadas = document.getElementById('modalAgregarParadas');
const salirParadas = document.getElementById('salirParadas');

abrirModalParadas.addEventListener('click', () => {
  modalAgregarParadas.classList.add('showParadas'); 
  modalAgregar.classList.remove('show');
});

salirParadas.addEventListener('click', () => {
  modalAgregarParadas.classList.remove('showParadas');
  modalAgregar.classList.add('show'); 
});