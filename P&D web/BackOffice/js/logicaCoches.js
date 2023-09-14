////////////////////////////////////////////
//             agregar coches             //
////////////////////////////////////////////
document.getElementById("agregar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaForm = document.getElementById("advertenciaForm");
  const elementoAdvertencia = document.querySelector(".advertenciaForm");

  // Obtener los valores de los campos del formulario
  const matricula = document.getElementById("matricula").value;
  const modelo = document.getElementById("modelo").value;
  const marca = document.getElementById("marca").value;
  const coche = document.getElementById("coche").value;
  const asientos = document.getElementById("asientos").value;
  const pisos = document.getElementById("pisos").value;

  //guardar el parrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");

  const url = "logica/logica.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    matricula: matricula,
    modelo: modelo,
    marca: marca,
    coche: coche,
    asientos: asientos,
    pisos: pisos,
    accion: "registrarCoches",
  };

  const solicitud = {
    method: "POST", // metodo de envio de los datos
    headers: {
      "Content-Type": "application/json", // Indica que estás enviando JSON
    },
    body: JSON.stringify(datosAEnviar), // Convierte los datos en JSON
  };

  // Realizar la solicitud al servidor
  fetch(url, solicitud)
    .then((respuesta) => {
      if (!respuesta.ok) {
        throw new Error("Error en la solicitud al servidor");
      }
      return respuesta.json(); // Parsea la respuesta JSON del servidor
    })
    .then((data) => {
      // Manejar la respuesta del servidor
      if (data == "Coche ya registrado") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaForm"); //agrega la clase al parrafo
          parrafoExistente.textContent = cocheExiste; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
        } else {
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaForm"); //agrega la clase al parrafo
          nuevoParrafo.textContent = cocheExiste; //agrega el contenido al parrafo
          advertenciaForm.appendChild(nuevoParrafo); //agrega el parrafo al div
        }
      } else if (data == "Creado con exito") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-azul)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaForm"); //agrega la clase al parrafo
          parrafoExistente.textContent = creadoConExito; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
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
          elementoAdvertencia.style.color = "var(--semantico-azul)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaForm"); //agrega la clase al parrafo
          parrafoExistente.textContent = creadoConExito; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
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
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaForm"); //agrega la clase al parrafo
          parrafoExistente.textContent = datosMalIngresados; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
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

////////////////////////////////////////////
//             mostrar coches             //
////////////////////////////////////////////
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
    // Realizar la búsqueda como se hizo antes
    for (let i = 0; i < displayedData.length; i++) {
      const numOmnibus = displayedData[i].numOmnibus.toLowerCase();
      const matricula = displayedData[i].matricula.toLowerCase();
      const modelo = displayedData[i].modelo.toLowerCase();
      const marca = displayedData[i].marca.toLowerCase();
      const cantidadAsientos = displayedData[i].cantidadAsientos.toLowerCase();
      const pisos = displayedData[i].pisos.toLowerCase();
      const idUsuarioAdmi = displayedData[i].idUsuarioAdmi.toLowerCase();
      if (
        numOmnibus.startsWith(searchTerm) ||
        matricula.startsWith(searchTerm) ||
        modelo.startsWith(searchTerm) ||
        marca.startsWith(searchTerm) ||
        cantidadAsientos.startsWith(searchTerm) ||
        pisos.startsWith(searchTerm) ||
        idUsuarioAdmi.startsWith(searchTerm)
      ) {
        // startsWith hace que aparezcan todas las filas que tienen alguna celda que empiece con la palabra
        const newRow = table.insertRow(-1); //agrega una fila a la columna

        const checkboxCell = newRow.insertCell(0); //agrega una nueva celda en la fila
        const CocheCell = newRow.insertCell(1);
        const MatriculaCell = newRow.insertCell(2);
        const ModeloCell = newRow.insertCell(3);
        const MarcaCell = newRow.insertCell(4);
        const AsientosCell = newRow.insertCell(5);
        const PisosCell = newRow.insertCell(6);
        const creadorCell = newRow.insertCell(7);

        checkboxCell.innerHTML =
          "<input onclick='borrarCoches(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>"; //agrega el contenido a la celda
        CocheCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].numOmnibus.toLowerCase() +
          "'>";
        MatriculaCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].matricula.toLowerCase() +
          "'>";
        ModeloCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].modelo.toLowerCase() +
          "'>";
        MarcaCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].marca.toLowerCase() +
          "'>";
        AsientosCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].cantidadAsientos.toLowerCase() +
          "'>";
        PisosCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].pisos.toLowerCase() +
          "'>";
        creadorCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedData[i].idUsuarioAdmi.toLowerCase() +
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
    accion: "mostrarCoches",
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

        const checkboxCell = newRow.insertCell(0); //agrega una nueva celda en la fila
        const CocheCell = newRow.insertCell(1);
        const MatriculaCell = newRow.insertCell(2);
        const ModeloCell = newRow.insertCell(3);
        const MarcaCell = newRow.insertCell(4);
        const AsientosCell = newRow.insertCell(5);
        const PisosCell = newRow.insertCell(6);
        const creadorCell = newRow.insertCell(7);

        checkboxCell.innerHTML =
          "<input onclick='borrarCoches(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>"; //agrega el contenido a la celda
        CocheCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].numOmnibus +
          "'>";
        MatriculaCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].matricula +
          "'>";
        ModeloCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].modelo +
          "'>";
        MarcaCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].marca +
          "'>";
        AsientosCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].cantidadAsientos +
          "'>";
        PisosCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].pisos +
          "'>";
        creadorCell.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].idUsuarioAdmi +
          "'>";

        // Almacenar los datos en displayedData
        displayedData.push({
          numOmnibus: data[i].numOmnibus,
          matricula: data[i].matricula,
          modelo: data[i].modelo,
          marca: data[i].marca,
          cantidadAsientos: data[i].cantidadAsientos,
          pisos: data[i].pisos,
          idUsuarioAdmi: data[i].idUsuarioAdmi,
        });
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}

////////////////////////////////////////////
//             modificar coches           //
////////////////////////////////////////////
document.getElementById("modificar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaForm = document.getElementById("advertenciaFormMod");
  const elementoAdvertencia = document.querySelector(".advertenciaFormMod"); //guarda la clase advertenciaFormMod
  const advertenciaBorrar = document.getElementById("advertenciaBorrar");
  const elementoAdvertenciaExito = document.querySelector(".advertenciaBorrar");

  // Obtener los valores de los campos del formulario
  const matriculaAnterior = document.getElementById("inputMatCam").value;
  const matricula = document.getElementById("inputMatricula").value;
  const modelo = document.getElementById("inputModelo").value;
  const marca = document.getElementById("inputMarca").value;
  const coche = document.getElementById("inputCoche").value;
  const asientos = document.getElementById("inputAsientos").value;
  const pisos = document.getElementById("inputPisos").value;

  //guardar el parrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");
  const parrafoexito = advertenciaBorrar.querySelector("p");

  const url = "logica/logica.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    matriculaAnterior: matriculaAnterior,
    matricula: matricula,
    modelo: modelo,
    marca: marca,
    coche: coche,
    asientos: asientos,
    pisos: pisos,
    accion: "modificarCoches",
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
      } else if (data == "matricula ya registrada") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaFormMod"); //agrega la clase al parrafo
          parrafoExistente.textContent = matriculaExiste; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
        } else {
          const nuevoParrafo = document.createElement("p");
          elementoAdvertencia.style.color = "var(--semantico-rojo)";
          nuevoParrafo.classList.add("advertenciaFormMod");
          nuevoParrafo.textContent = matriculaExiste;
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

/////////////////////////////////////////////
//          borrado logico coches          //
/////////////////////////////////////////////
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
    accion: "borrarCoches",
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
      if (data == "Coche borrado") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          parrafoExistente.textContent = cocheBorrado; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(parrafoExistente); //agrega el parrafo al div
          setTimeout(function () {
            advertenciaBorrar.removeChild(parrafoExistente);
          }, 5000);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          nuevoParrafo.textContent = cocheBorrado; //agrega el contenido al parrafo
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
