//modal agregar
const abrirModal = document.getElementById("abrirModal"); //variable que guarda el boton de nuevo usuario mediante su id
const atras = document.getElementById("atras"); //variable que guarda el boton para salir del modal de nuevo usuario mediante su id
const elemento = document.querySelector(".modalAgregar"); //variable que guarda la clase 'modalAgregar'

//activa el modal agregar
abrirModal.addEventListener("click", () => {
  elemento.style.opacity = "1"; //hace que el modal sea visible
  elemento.style.pointerEvents = "auto"; //hace que se active su funcionalidad
});

//desactiva el modal agregar
atras.addEventListener("click", () => {
  elemento.style.opacity = "0%"; //hace que el modal no sea visible
  elemento.style.pointerEvents = "none"; //hace que se desactive su funcionalidad
  const advertenciaForm = document.getElementById("advertenciaForm");
  const parrafoExistente = advertenciaForm.querySelector("p"); //guardar el parrafo en caso de que exista
  if (parrafoExistente) {
    advertenciaForm.removeChild(parrafoExistente);
  }
  // Selecciona todos los elementos input dentro del modal
  const inputs = document.querySelectorAll("#modalAgregar input");

  // Establece el valor de cada input en una cadena vacía
  inputs.forEach((input) => {
    input.value = "";
  });
});

//modal agregar coches
const abrirModalHorarios = document.getElementById("abrirModalCoches");
const modalAgregarHorarios = document.getElementById("modalAgregarCoches");
const salirHorarios = document.getElementById("salirCoches");

abrirModalHorarios.addEventListener("click", () => {
  modalAgregarHorarios.classList.add("showCoches");
  modalAgregar.classList.remove("show");
});

salirHorarios.addEventListener("click", () => {
  modalAgregarHorarios.classList.remove("showCoches");
  modalAgregar.classList.add("show");
});

//modal agregar rutas
const abrirModalParadas = document.getElementById("abrirModalRutas");
const modalAgregarParadas = document.getElementById("modalAgregarRutas");
const salirParadas = document.getElementById("salirRutas");

abrirModalParadas.addEventListener("click", () => {
  modalAgregarParadas.classList.add("showRutas");
  modalAgregar.classList.remove("show");
});

salirParadas.addEventListener("click", () => {
  modalAgregarParadas.classList.remove("showRutas");
  modalAgregar.classList.add("show");
});

// Comprobar si el dato de sesión existe
if (userComun !== '') {
  // Utilizar el valor almacenado en la sesión
  console.log('Nombre de usuario: ' + userComun);
  document.getElementById('pUsuario').style.display = 'none';
}