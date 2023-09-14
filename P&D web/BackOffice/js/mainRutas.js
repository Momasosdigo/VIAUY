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
  document.getElementById("abrirModalParadas").style.backgroundColor =
    "var(--neutral-gris)"; //seleccionado
  document.getElementById("abrirModalParadas").style.pointerEvents = "none";

  const botonesEliminar = document.querySelectorAll(".eliminarParada");
  botonesEliminar.forEach((boton) => {
      const fila = boton.closest("tr"); // Obtener la fila padre del botón
      if (fila) {
        fila.remove(); // Eliminar la fila
      }
  });

  contadorNP = 0;

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

//modal agregar paradas
const abrirModalParadas = document.getElementById("abrirModalParadas");
const modalAgregarParadas = document.getElementById("modalAgregarParadas");
const salirParadas = document.getElementById("salirParadas");

abrirModalParadas.addEventListener("click", () => {
  modalAgregarParadas.classList.add("showParadas");
  modalAgregar.classList.remove("show");
});

salirParadas.addEventListener("click", () => {
  modalAgregarParadas.classList.remove("showParadas");
  modalAgregar.classList.add("show");
  document.getElementById("abrirModalParadas").style.backgroundColor =
    "var(--neutral-gris)"; //seleccionado
  document.getElementById("abrirModalParadas").style.pointerEvents = "none";
});

// Comprobar si el dato de sesión existe
if (userComun !== "") {
  // Utilizar el valor almacenado en la sesión
  console.log("Nombre de usuario: " + userComun);
  document.getElementById("pUsuario").style.display = "none";
}

// Obtén una referencia al input
const inputMP = document.getElementById("selecInput");
const contenidoMP = document.querySelector(".dropdownContenido");

inputMP.addEventListener("click", function () {
  // Muestra el contenido del menú desplegable cuando se hace clic en el input
  contenidoMP.style.display = "block";
});

document.addEventListener("click", function (e) {
  if (e.target !== inputMP && !contenidoMP.contains(e.target)) {
    // Oculta el contenido del menú desplegable cuando se hace clic en cualquier otro lugar
    contenidoMP.style.display = "none";
  }
});

// Obtén una referencia al input
const inputOr = document.getElementById("inputOrigen");
const contenidoO = document.querySelector(".dropdownContenidoO");

inputOr.addEventListener("click", function () {
  // Muestra el contenido del menú desplegable cuando se hace clic en el input
  contenidoO.style.display = "block";
});

document.addEventListener("click", function (e) {
  if (e.target !== inputOr && !contenidoO.contains(e.target)) {
    // Oculta el contenido del menú desplegable cuando se hace clic en otro lugar
    contenidoO.style.display = "none";
  }
});

// Obtén una referencia al input
const inputD = document.getElementById("inputDestino");
const contenidoD = document.querySelector(".dropdownContenidoD");

inputD.addEventListener("click", function () {
  // Muestra el contenido del menú desplegable cuando se hace clic en el input
  contenidoD.style.display = "block";
});

document.addEventListener("click", function (e) {
  if (e.target !== inputD && !contenidoD.contains(e.target)) {
    // Oculta el contenido del menú desplegable cuando se hace clic en otro lugar
    contenidoD.style.display = "none";
  }
});

// permitir solo un check activado
function disableOtherChecks(checkedCheckbox) {
  // Obtenemos todos los checkboxes.
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const editar = document.querySelector(".editar");
  const borrar = document.querySelector(".borrar");

  // Recorremos los checkboxes y se desactivan si no son el checkbox activado.
  checkboxes.forEach(function (checkbox) {
    if (checkbox !== checkedCheckbox) {
      checkbox.disabled = checkedCheckbox.checked;
    }
  });

  // Cambiamos el color del botón editar dependiendo del estado del checkbox.
  if (checkedCheckbox.checked) {
    editar.style.backgroundColor = "var(--primario-90)"; //seleccionado
    editar.style.pointerEvents = "auto";
    borrar.style.backgroundColor = "var(--semantico-rojo)";
    borrar.style.pointerEvents = "auto";
  } else {
    editar.style.backgroundColor = "var(--neutral-gris)"; //no seleccionado vuelven a su color original
    editar.style.pointerEvents = "none";
    borrar.style.backgroundColor = "var(--neutral-gris)";
    borrar.style.pointerEvents = "none";
  }
}

function borrarRuta() {
  const filas = document.querySelectorAll("#table tr");
  filas.forEach((fila) => {
    const checkbox = fila.querySelector(".seleccionarFila");
    if (checkbox.checked) {
      const celdas = fila.getElementsByTagName("td");
      const id = celdas[1].querySelector("input").value;

      const borrarUsuario = document.getElementById("claveBorrar");
      borrarUsuario.value = id;
    }
  });
}
