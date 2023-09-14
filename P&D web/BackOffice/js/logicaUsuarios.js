//////////////////////////////////////////////
//             agregar usuarios             //
//////////////////////////////////////////////
document.getElementById("agregar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaForm = document.getElementById("advertenciaForm");
  const elementoAdvertencia = document.querySelector(".advertenciaForm");
  // Obtener los valores de los campos del formulario
  const nombre = document.getElementById("nombre").value;
  const apellido = document.getElementById("apellido").value;
  const cedula = document.getElementById("cedula").value;
  const clave = document.getElementById("clave").value;

  // Guardar el párrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");

  const url = "logica/logica.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    nombre: nombre,
    apellido: apellido,
    cedula: cedula,
    clave: clave,
    accion: "registrarUsuarios",
  };

  const solicitud = {
    method: "POST", // metodo de envio de los datos
    headers: {
      "Content-Type": "application/json", // Indica que estás enviando JSON
    },
    body: JSON.stringify(datosAEnviar), // Convierte los datos en JSON
  };

  // Realiza la solicitud al servidor
  fetch(url, solicitud)
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error("Error en la solicitud al servidor");
      }
      return respuesta.json(); // Parsea la respuesta JSON del servidor
    })
    .then((data) => {
      // Maneja la respuesta del servidor
      if (data == "el usuario ya existe") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          parrafoExistente.classList.add("advertenciaForm");
          parrafoExistente.textContent = usuarioExiste;
          advertenciaForm.appendChild(parrafoExistente);
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          nuevoParrafo.classList.add("advertenciaForm");
          nuevoParrafo.textContent = usuarioExiste;
          advertenciaForm.appendChild(nuevoParrafo);
        }
      } else if (data == "Creado con exito") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          parrafoExistente.classList.add("advertenciaForm");
          parrafoExistente.textContent = creadoConExito;
          advertenciaForm.appendChild(parrafoExistente);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          nuevoParrafo.classList.add("advertenciaForm");
          nuevoParrafo.textContent = creadoConExito;
          advertenciaForm.appendChild(nuevoParrafo);
          actualizarTabla();
        }
      } else if (data == "Creado con exito 2") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          parrafoExistente.classList.add("advertenciaForm");
          parrafoExistente.textContent = creadoConExito;
          advertenciaForm.appendChild(parrafoExistente);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          nuevoParrafo.classList.add("advertenciaForm");
          nuevoParrafo.textContent = creadoConExito;
          advertenciaForm.appendChild(nuevoParrafo);
          actualizarTabla();
        }
      } else if (data == "Creado con exito 3") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          parrafoExistente.classList.add("advertenciaForm");
          parrafoExistente.textContent = creadoConExito;
          advertenciaForm.appendChild(parrafoExistente);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-azul)";
          nuevoParrafo.classList.add("advertenciaForm");
          nuevoParrafo.textContent = creadoConExito;
          advertenciaForm.appendChild(nuevoParrafo);
          actualizarTabla();
        }
      } else {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          parrafoExistente.classList.add("advertenciaForm");
          parrafoExistente.textContent = datosMalIngresados;
          advertenciaForm.appendChild(parrafoExistente);
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          nuevoParrafo.classList.add("advertenciaForm");
          nuevoParrafo.textContent = datosMalIngresados;
          advertenciaForm.appendChild(nuevoParrafo);
        }
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
});

//////////////////////////////////////////////
//             mostrar usuarios             //
//////////////////////////////////////////////
// Obtener la referencia a la tabla existente
const table = document.getElementById("table");

actualizarTabla();

// Manejar la búsqueda
const searchInput = document.getElementById("searchInput"); //guarda el input de buscar
const searchButton = document.getElementById("searchButton"); //guarda el boton de buscar

searchButton.addEventListener("click", function () {
  const searchTerm = searchInput.value.toLowerCase(); //guarda lo que escribio la persona en el input

  // Limpiar la tabla antes de realizar la búsqueda
  while (table.rows.length > 1) {
    table.deleteRow(1);
  }

  if (searchTerm == "") {
    actualizarTabla();
  } else {
    // Realizar la búsqueda con los datos almacenados en displayedData
    for (let i = 0; i < displayedData.length; i++) {
      const nombre = displayedData[i].nombre.toLowerCase();
      const apellido = displayedData[i].apellido.toLowerCase();
      const cedula = displayedData[i].id.toLowerCase();
      if (
        nombre.startsWith(searchTerm) ||
        apellido.startsWith(searchTerm) ||
        cedula.startsWith(searchTerm)
      ) {
        const newRow = table.insertRow(-1);
        const checkboxCell = newRow.insertCell(0); //agrega una nueva celda en la fila
        const idCell = newRow.insertCell(1);
        const nombreCell = newRow.insertCell(2);
        const apellidoCell = newRow.insertCell(3);

        checkboxCell.innerHTML =
          "<input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>";
        idCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].id +
          "'>";
        nombreCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].nombre +
          "'>";
        apellidoCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].apellido +
          "'>";
      }
    }
  }
});

// Función para actualizar la tabla con los datos
function actualizarTabla() {
  const editar = document.querySelector(".editar");
  const borrar = document.querySelector(".borrar");
  editar.style.backgroundColor = "var(--neutral-gris)"; //no seleccionado vuelven a su color original
  editar.style.pointerEvents = "none";
  borrar.style.backgroundColor = "var(--neutral-gris)";
  borrar.style.pointerEvents = "none";

  const url = "logica/logica.php";

  const datosAEnviar = {
    accion: "mostrarUsuarios",
  };

  const solicitud = {
    method: "POST", // metodo de envio de los datos
    headers: {
      "Content-Type": "application/json", // Indica que estás enviando JSON
    },
    body: JSON.stringify(datosAEnviar), // Convierte los datos en JSON
  };

  fetch(url, solicitud)
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error("Error en la solicitud al servidor");
      }
      return respuesta.json(); // Parsea la respuesta JSON del servidor
    })
    .then((data) => {
      // Maneja la respuesta del servidor

      // Obtener la referencia a la tabla existente
      const table = document.getElementById("table");

      // Limpiar la tabla antes de actualizar
      while (table.rows.length > 1) {
        table.deleteRow(1);
      }

      displayedData = []; // Limpiar los datos almacenados previamente

      // Agregar las filas con los nuevos datos
      for (let i = 0; i < data.length; i++) {
        const newRow = table.insertRow(-1);
        const checkboxCell = newRow.insertCell(0);
        const idCell = newRow.insertCell(1);
        const nombreCell = newRow.insertCell(2);
        const apellidoCell = newRow.insertCell(3);

        checkboxCell.innerHTML =
          "<input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>";
        idCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].idUsuarioBack +
          "'>";
        nombreCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].nombreBack +
          "'>";
        apellidoCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].apellidoBack +
          "'>";

        // Almacenar los datos en displayedData
        displayedData.push({
          id: data[i].idUsuarioBack,
          nombre: data[i].nombreBack,
          apellido: data[i].apellidoBack,
        });
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}

//////////////////////////////////////////////
//             modificar usuarios           //
//////////////////////////////////////////////
document.getElementById("modificar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaForm = document.getElementById("advertenciaFormMod");
  const advertenciaBorrar = document.getElementById("advertenciaBorrar");
  const elementoAdvertenciaExito = document.querySelector(".advertenciaBorrar");
  const elementoAdvertencia = document.querySelector(".advertenciaFormMod"); //guarda la clase advertenciaFormMod
  // Obtener los valores de los campos del formulario
  const cedulaAnterior = document.getElementById("inputCedCam").value;
  const nombre = document.getElementById("inputNom").value;
  const apellido = document.getElementById("inputApe").value;
  const cedula = document.getElementById("inputCed").value;
  const clave = document.getElementById("inputCla").value;

  //guardar el parrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");
  const parrafoexito = advertenciaBorrar.querySelector("p");

  const url = "logica/logica.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    cedulaAnterior: cedulaAnterior,
    nombre: nombre,
    apellido: apellido,
    cedula: cedula,
    clave: clave,
    accion: "modificarUsuarios",
  };

  const solicitud = {
    method: "POST", // metodo de envio de los datos
    headers: {
      "Content-Type": "application/json", // Indica que estás enviando JSON
    },
    body: JSON.stringify(datosAEnviar), // Convierte los datos en JSON
  };

  // Realiza la solicitud al servidor
  fetch(url, solicitud)
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error("Error en la solicitud al servidor");
      }
      return respuesta.json(); // Parsea la respuesta JSON del servidor
    })
    .then((data) => {
      // Maneja la respuesta del servidor
      if (data == "modificado con exito") {
        if (parrafoexito) {
          elementoAdvertenciaExito.style.color = "var(--semantico-azul)"; //agrega el color a usar en la clase del parrafo
          parrafoexito.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          parrafoexito.textContent = modificadoConExito; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(parrafoExistente); //agrega el parrafo al div
          elementoEditar.style.opacity = "0%"; //hace que el modal no sea visible
          elementoEditar.style.pointerEvents = "none";
          setTimeout(function () {
            advertenciaBorrar.removeChild(parrafoexito);
          }, 5000);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia
          elementoAdvertenciaExito.style.color = "var(--semantico-azul)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          nuevoParrafo.textContent = modificadoConExito; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(nuevoParrafo); //agrega el parrafo al div
          elementoEditar.style.opacity = "0%"; //hace que el modal no sea visible
          elementoEditar.style.pointerEvents = "none";
          setTimeout(function () {
            advertenciaBorrar.removeChild(nuevoParrafo);
          }, 5000);
          actualizarTabla();
        }
      } else if (data == "cedula ya registrada") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaFormMod"); //agrega la clase al parrafo
          parrafoExistente.textContent = cedulaExiste; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          nuevoParrafo.classList.add("advertenciaFormMod");
          nuevoParrafo.textContent = cedulaExiste;
          advertenciaForm.appendChild(nuevoParrafo);
        }
      } else if (data == "modificado con exito 2") {
        if (parrafoExistente) {
          elementoAdvertenciaExito.style.color = "var(--semantico-azul)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          parrafoexito.textContent = modificadoConExito; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(parrafoExistente); //agrega el parrafo al div
          elementoEditar.style.opacity = "0%"; //hace que el modal no sea visible
          elementoEditar.style.pointerEvents = "none";
          setTimeout(function () {
            advertenciaBorrar.removeChild(parrafoexito);
          }, 5000);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertenciaExito.style.color = "var(--semantico-azul)";
          nuevoParrafo.classList.add("advertenciaBorrar");
          nuevoParrafo.textContent = modificadoConExito;
          advertenciaBorrar.appendChild(nuevoParrafo);
          elementoEditar.style.opacity = "0%"; //hace que el modal no sea visible
          elementoEditar.style.pointerEvents = "none";
          setTimeout(function () {
            advertenciaBorrar.removeChild(nuevoParrafo);
          }, 5000);
          actualizarTabla();
        }
      } else {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaFormMod"); //agrega la clase al parrafo
          parrafoExistente.textContent = datosMalIngresados; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          nuevoParrafo.classList.add("advertenciaFormMod");
          nuevoParrafo.textContent = datosMalIngresados;
          advertenciaForm.appendChild(nuevoParrafo);
        }
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
});

//////////////////////////////////////////////
//          borrado logico usuarios         //
//////////////////////////////////////////////
document.getElementById("borrar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaBorrar = document.getElementById("advertenciaBorrar");
  const elementoAdvertencia = document.querySelector(".advertenciaBorrar"); //guarda la clase advertenciaBorrar

  //guardar el parrafo en caso de que exista
  const parrafoExistente = advertenciaBorrar.querySelector("p");

  // Obtener los valores de los campos del formulario
  const claveBorrar = document.getElementById("claveBorrar").value;

  const url = "logica/logica.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    claveBorrar: claveBorrar,
    accion: "borrarUsuarios",
  };

  const solicitud = {
    method: "POST", // metodo de envio de los datos
    headers: {
      "Content-Type": "application/json", // Indica que estás enviando JSON
    },
    body: JSON.stringify(datosAEnviar), // Convierte los datos en JSON
  };

  // Realiza la solicitud al servidor
  fetch(url, solicitud)
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error("Error en la solicitud al servidor");
      }
      return respuesta.json(); // Parsea la respuesta JSON del servidor
    })
    .then((data) => {
      // Maneja la respuesta del servidor
      if (data == "Usuario borrado") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          parrafoExistente.textContent = usuarioBorrado; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(parrafoExistente); //agrega el parrafo al div
          setTimeout(function () {
            advertenciaBorrar.removeChild(parrafoExistente);
          }, 5000);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          nuevoParrafo.textContent = usuarioBorrado; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(nuevoParrafo); //agrega el parrafo al div
          setTimeout(function () {
            advertenciaBorrar.removeChild(nuevoParrafo);
          }, 5000);
          actualizarTabla();
        }
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
});
