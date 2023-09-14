//modal agregar
const abrirModal = document.getElementById("abrirModal"); //constiable que guarda el boton de nuevo Coche mediante su id
const atras = document.getElementById("atras"); //constiable que guarda el boton para salir del modal de nuevo Coche mediante su id
const elemento = document.querySelector(".modalAgregar"); //constiable que guarda la clase 'modalAgregar'

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
      const coche = celdas[1].querySelector("input").value;
      const matricula = celdas[2].querySelector("input").value;
      const modelo = celdas[3].querySelector("input").value;
      const marca = celdas[4].querySelector("input").value;
      const asientos = celdas[5].querySelector("input").value;
      const pisos = celdas[6].querySelector("input").value;

      const inputMatCam = document.getElementById("inputMatCam");
      const inputMatricula = document.getElementById("inputMatricula");
      const inputModelo = document.getElementById("inputModelo");
      const inputMarca = document.getElementById("inputMarca");
      const inputCoche = document.getElementById("inputCoche");
      const inputAsientos = document.getElementById("inputAsientos");
      const inputPisos = document.getElementById("inputPisos");

      inputMatCam.value = matricula;
      inputMatricula.value = matricula;
      inputModelo.value = modelo;
      inputMarca.value = marca;
      inputCoche.value = coche;
      inputAsientos.value = asientos;
      inputPisos.value = pisos;
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

//carga en un input oculto la matricula del Coche a borrar
function borrarCoches() {
  const filas = document.querySelectorAll("#table tr");
  filas.forEach((fila) => {
    const checkbox = fila.querySelector(".seleccionarFila");
    if (checkbox.checked) {
      const celdas = fila.getElementsByTagName("td");
      const matricula = celdas[2].querySelector("input").value;

      const borrar = document.getElementById("claveBorrar");
      borrar.value = matricula;
    }
  });
}

// permitir solo un check activado
function disableOtherChecks(checkedCheckbox) {
  // Obtenemos todos los checkboxes.
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
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

// Comprobar si el dato de sesión existe
if (userComun !== '') {
  // Utilizar el valor almacenado en la sesión
  console.log('Nombre de usuario: ' + userComun);
  document.getElementById('pUsuario').style.display = 'none';
}