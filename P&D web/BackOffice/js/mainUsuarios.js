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

//modal editar
const elementoEditar = document.querySelector(".modalEditar");
function guardarDatosFila() {
  const filas = document.querySelectorAll("#table tr");
  filas.forEach((fila) => {
    const checkbox = fila.querySelector(".seleccionarFila");
    if (checkbox.checked) {
      const celdas = fila.getElementsByTagName("td");
      const id = celdas[1].querySelector("input").value;
      const nombre = celdas[2].querySelector("input").value;
      const apellido = celdas[3].querySelector("input").value;

      const inputCedCam = document.getElementById("inputCedCam");
      const inputCed = document.getElementById("inputCed");
      const inputNom = document.getElementById("inputNom");
      const inputApe = document.getElementById("inputApe");

      inputCedCam.value = id;
      inputCed.value = id;
      inputNom.value = nombre;
      inputApe.value = apellido;
      elementoEditar.style.opacity = "1"; //hace que el modal sea visible
      elementoEditar.style.pointerEvents = "auto"; //hace que se active su funcionalidad
    }
  });
}

const atrasEditar = document.getElementById("atrasEditar");

atrasEditar.addEventListener("click", () => {
  elementoEditar.style.opacity = "0%"; //hace que el modal no sea visible
  elementoEditar.style.pointerEvents = "none"; //hace que se desactive su funcionalidad
  const advertenciaForm = document.getElementById("advertenciaFormMod");
  const parrafoExistente = advertenciaForm.querySelector("p"); //guardar el parrafo en caso de que exista
  if (parrafoExistente) {
    advertenciaForm.removeChild(parrafoExistente);
  }
  // Selecciona todos los elementos input dentro del modal
  const inputs = document.querySelectorAll("#modalEditar input");

  // Establece el valor de cada input en una cadena vacía
  inputs.forEach((input) => {
    input.value = "";
  });
});

//carga en un input oculto la cedula del usuario a borrar
function borrarUsuario() {
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

//pruebas
function validarNumeros(event) {
  const charCode = event.which ? event.which : event.keyCode;
  const esNumero = charCode >= 48 && charCode <= 57;

  if (!esNumero) {
  }
  return esNumero;
}
