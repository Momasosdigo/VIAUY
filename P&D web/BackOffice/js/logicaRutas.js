//////////////////////////////////////////////
//              agregar rutas               //
//////////////////////////////////////////////
document.getElementById("agregar").addEventListener("submit", function (e) {
  e.preventDefault();
  const advertenciaForm = document.getElementById("advertenciaForm");
  const elementoAdvertencia = document.querySelector(".advertenciaForm");

  // Obtener los valores de los campos del formulario
  const idOrigen = document.getElementById("origenOculto").value;
  const idDestino = document.getElementById("destinoOculto").value;
  const idRuta = document.getElementById("idRuta").value;
  const precioTotal = parseInt(
    document.getElementById("precioTotal").value,
    10
  );

  // Guardar el párrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");
  
  if (idOrigen == idDestino) {
    if (parrafoExistente) {
      elementoAdvertencia.style.color = "var(--semantico-rojo)";
      parrafoExistente.classList.add("advertenciaForm");
      parrafoExistente.textContent = "Tu origen y destino no pueden ser los mismos";
      advertenciaForm.appendChild(parrafoExistente);
    } else {
      const nuevoParrafo = document.createElement("p");
      elementoAdvertencia.style.color = "var(--semantico-rojo)";
      nuevoParrafo.classList.add("advertenciaForm");
      nuevoParrafo.textContent = "Tu origen y destino no pueden ser los mismos";
      advertenciaForm.appendChild(nuevoParrafo);
    }
  }else{

    const url = "logica/logica.php";
  
    const datosAEnviar = {
      idRuta:idRuta,
      idOrigen: idOrigen,
      idDestino: idDestino,
      precioTotal: precioTotal,
      accion: "registrarRutas",
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
        if (data == "listo") {
          if (parrafoExistente) {
            document.getElementById("abrirModalParadas").style.backgroundColor =
              "var(--primario-90)"; //seleccionado
            document.getElementById("abrirModalParadas").style.pointerEvents = "auto";
            elementoAdvertencia.style.color = "var(--semantico-azul)";
            parrafoExistente.classList.add("advertenciaForm");
            parrafoExistente.textContent = creadoConExito;
            advertenciaForm.appendChild(parrafoExistente);
            actualizarTabla();
          }else{
            document.getElementById("abrirModalParadas").style.backgroundColor =
              "var(--primario-90)"; //seleccionado
            document.getElementById("abrirModalParadas").style.pointerEvents = "auto";
            const nuevoParrafo = document.createElement("p");
            elementoAdvertencia.style.color = "var(--semantico-azul)";
            nuevoParrafo.classList.add("advertenciaForm");
            nuevoParrafo.textContent = creadoConExito;
            advertenciaForm.appendChild(nuevoParrafo);
            actualizarTabla();
          }
        }else if (data == "activado") {
          if (parrafoExistente) {
            document.getElementById("abrirModalParadas").style.backgroundColor =
              "var(--primario-90)"; //seleccionado
            document.getElementById("abrirModalParadas").style.pointerEvents = "auto";
            elementoAdvertencia.style.color = "var(--semantico-azul)";
            parrafoExistente.classList.add("advertenciaForm");
            parrafoExistente.textContent = "Identificador ya existente";
            advertenciaForm.appendChild(parrafoExistente);
            actualizarTabla();
          }else{
            document.getElementById("abrirModalParadas").style.backgroundColor =
              "var(--primario-90)"; //seleccionado
            document.getElementById("abrirModalParadas").style.pointerEvents = "auto";
            const nuevoParrafo = document.createElement("p");
            elementoAdvertencia.style.color = "var(--semantico-azul)";
            nuevoParrafo.classList.add("advertenciaForm");
            nuevoParrafo.textContent = "Ruta ya existente";
            advertenciaForm.appendChild(nuevoParrafo);
            actualizarTabla();
          }
        }else{
          if (parrafoExistente) {
            elementoAdvertencia.style.color = "var(--semantico-rojo)";
            parrafoExistente.classList.add("advertenciaForm");
            parrafoExistente.textContent = "Identificador ya existente";
            advertenciaForm.appendChild(parrafoExistente);
          } else {
            const nuevoParrafo = document.createElement("p");
            elementoAdvertencia.style.color = "var(--semantico-rojo)";
            nuevoParrafo.classList.add("advertenciaForm");
            nuevoParrafo.textContent = "Identificador ya existente";
            advertenciaForm.appendChild(nuevoParrafo);
          }
        }
  
      })
      .catch((error) => {
        console.error("Hubo un error:", error);
      });
  }

});

selecParada();

// Manejar la búsqueda em modal parada
const buscarPOrigen = document.getElementById("inputOrigen"); //guarda el input de buscar
const buscarPDestino = document.getElementById("inputDestino"); //guarda el input de buscar
const buscarPM = document.getElementById("selecInput"); //guarda el input de buscar


buscarPOrigen.addEventListener("input", function () {
  const searchTerm = buscarPOrigen.value.toLowerCase(); //guarda lo que escribio la persona en el input

  // Limpia el contenido anterior en seleccionarParada
  seleccionarParadaO.innerHTML = "";

  // Realiza la búsqueda y agrega los botones correspondientes
  for (let i = 0; i < displayedData.length; i++) {
    const coordenadas = displayedData[i].coordenadas.toLowerCase();
    if (coordenadas.includes(searchTerm)) {
      const button = document.createElement("button");
      button.type = "button";
      button.id = "botonParada" + displayedData[i].idParada;
      button.textContent = displayedData[i].coordenadas;
      seleccionarParadaO.appendChild(button);
    }
  }
  // Agregar los manejadores de eventos después de crear los botones
  const botones = document.querySelectorAll('[id^="botonParada"]');
  const input = document.getElementById("selecInput");
  const contenido = document.querySelector(".dropdownContenido");
  const paradaOculto = document.getElementById("paradaOculto");

  botones.forEach(function (boton) {
    boton.addEventListener("click", function () {
      // Asigna el valor del botón al campo de entrada
      input.value = boton.textContent;
      paradaOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
      // Oculta el contenido del menú desplegable
      contenido.style.display = "none";
    });
  });
});


buscarPDestino.addEventListener("input", function () {
  const searchTerm = buscarPDestino.value.toLowerCase(); //guarda lo que escribio la persona en el input

  // Limpia el contenido anterior en seleccionarParada
  seleccionarParadaD.innerHTML = "";

  // Realiza la búsqueda y agrega los botones correspondientes
  for (let i = 0; i < displayedData.length; i++) {
    const coordenadas = displayedData[i].coordenadas.toLowerCase();
    if (coordenadas.includes(searchTerm)) {
      const button = document.createElement("button");
      button.type = "button";
      button.id = "botonParada" + displayedData[i].idParada;
      button.textContent = displayedData[i].coordenadas;
      seleccionarParadaD.appendChild(button);
    }
  }
  // Agregar los manejadores de eventos después de crear los botones
  const botones = document.querySelectorAll('[id^="botonParada"]');
  const input = document.getElementById("selecInput");
  const contenido = document.querySelector(".dropdownContenido");
  const paradaOculto = document.getElementById("paradaOculto");

  botones.forEach(function (boton) {
    boton.addEventListener("click", function () {
      // Asigna el valor del botón al campo de entrada
      input.value = boton.textContent;
      paradaOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
      // Oculta el contenido del menú desplegable
      contenido.style.display = "none";
    });
  });
});

buscarPM.addEventListener("input", function () {
  const searchTerm = buscarPM.value.toLowerCase(); //guarda lo que escribio la persona en el input

  // Limpia el contenido anterior en seleccionarParada
  seleccionarParada.innerHTML = "";

  // Realiza la búsqueda y agrega los botones correspondientes
  for (let i = 0; i < displayedData.length; i++) {
    const coordenadas = displayedData[i].coordenadas.toLowerCase();
    if (coordenadas.includes(searchTerm)) {
      const button = document.createElement("button");
      button.type = "button";
      button.id = "botonParada" + displayedData[i].idParada;
      button.textContent = displayedData[i].coordenadas;
      seleccionarParada.appendChild(button);
    }
  }
  // Agregar los manejadores de eventos después de crear los botones
  const botones = document.querySelectorAll('[id^="botonParada"]');
  const input = document.getElementById("selecInput");
  const contenido = document.querySelector(".dropdownContenido");
  const paradaOculto = document.getElementById("paradaOculto");

  botones.forEach(function (boton) {
    boton.addEventListener("click", function () {
      // Asigna el valor del botón al campo de entrada
      input.value = boton.textContent;
      paradaOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
      // Oculta el contenido del menú desplegable
      contenido.style.display = "none";
    });
  });
});

//////////////////////////////////////////////
//             mostrar paradas              //
//////////////////////////////////////////////
function selecParada() {
  const url = "logica/logica.php";

  const datosAEnviar = {
    accion: "mostrarParadas",
  };
  const solicitud = {
    method: "POST", // método de envío de los datos
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
      const seleccionarParada = document.getElementById("seleccionarParada");
      const seleccionarParadaO = document.getElementById("seleccionarParadaO");
      const seleccionarParadaD = document.getElementById("seleccionarParadaD");

      displayedData = [];

      // Agregar las filas con los nuevos datos
      for (let i = 0; i < data.length; i++) {
        const button = document.createElement("button");
        button.type = "button";
        button.id = "botonParada" + data[i].idParada;
        button.textContent = data[i].coordenadas;
        seleccionarParada.appendChild(button);
        const buttonO = document.createElement("button");
        buttonO.type = "button";
        buttonO.id = "botonParada" + data[i].idParada;
        buttonO.textContent = data[i].coordenadas;
        seleccionarParadaO.appendChild(buttonO);
        const buttonD = document.createElement("button");
        buttonD.type = "button";
        buttonD.id = "botonParada" + data[i].idParada;
        buttonD.textContent = data[i].coordenadas;
        seleccionarParadaD.appendChild(buttonD);
        displayedData.push({
          idParada: data[i].idParada,
          coordenadas: data[i].coordenadas,
        });
      }
      // Agregar los manejadores de eventos después de crear los botones
      const botones = document.querySelectorAll('[id^="botonParada"]');
      const input = document.getElementById("selecInput");
      const inputOr = document.getElementById("inputOrigen");
      const inputD = document.getElementById("inputDestino");
      const origenOculto = document.getElementById("origenOculto");
      const destinoOculto = document.getElementById("destinoOculto");
      const paradaOculto = document.getElementById("paradaOculto");
      const contenido = document.querySelector(".dropdownContenido");
      const contenidoO = document.querySelector(".dropdownContenidoO");
      const contenidoD = document.querySelector(".dropdownContenidoD");

      botones.forEach(function (boton) {
        boton.addEventListener("click", function () {
          // Verifica si el inputO tiene el foco
          if (contenidoO.style.display === "block") {
            // Asigna el valor del botón al campo de entrada con foco (inputO)
            origenOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
            inputOr.value = boton.textContent;
            // Oculta el contenido del menú desplegable correspondiente (contenidoO)
            contenidoO.style.display = "none";
          } else if (contenido.style.display === "block") {
            // Asigna el valor del botón al campo de entrada con foco (input)
            paradaOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
            input.value = boton.textContent;
            // Oculta el contenido del menú desplegable correspondiente (contenido)
            contenido.style.display = "none";
          } else if (contenidoD.style.display === "block") {
            // Asigna el valor del botón al campo de entrada con foco (input)
            destinoOculto.value = parseInt(boton.id.replace(/\D/g, ""), 10);
            inputD.value = boton.textContent;
            // Oculta el contenido del menú desplegable correspondiente (contenido)
            contenidoD.style.display = "none";
          }
        });
      });
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}

//////////////////////////////////////////////
//             agregar paradas              //
//////////////////////////////////////////////

let contadorNP = 0;

document.getElementById("AgregarParada").addEventListener("click", function () {
  const paradaOculto = parseInt(
    document.getElementById("paradaOculto").value.replace(/\D/g, ""),
    10
  );

  const input = document.getElementById("selecInput").value;
  const tablaParadas = document.getElementById("tablaParadas");
  const seleccionarParada = document.querySelectorAll('[id^="botonParada"]');
  const arrayParada = Array.from(seleccionarParada).map((elemento) =>
    parseInt(elemento.id.replace(/\D/g, ""), 10)
  );

  if (document.getElementById("newRow" + paradaOculto)) {
    alert("parada ya agregada");
  } else if (
    document.getElementById("origenOculto").value ==
    document.getElementById("paradaOculto").value
  ) {
    alert("ya lo agregaste como origen");
  } else if (
    document.getElementById("destinoOculto").value ==
    document.getElementById("paradaOculto").value
  ) {
    alert("ya lo agregaste como destino");
  } else if (arrayParada.includes(paradaOculto)) {
    const newRow = tablaParadas.insertRow(-1);
    const numeroParada = newRow.insertCell(0);
    const nombreParada = newRow.insertCell(1);
    const botonEParada = newRow.insertCell(2);
    const idParada = newRow.insertCell(3);
    contadorNP++;

    newRow.id = "newRow" + paradaOculto;
    numeroParada.innerHTML = contadorNP;
    idParada.innerHTML = "<input type='hidden'  value='" + paradaOculto + "'>";
    nombreParada.innerHTML = input;
    botonEParada.innerHTML =
      "<button id='eliminarParada' class='eliminarParada' onclick='eliminarFila(this)'><i class='fa-solid fa-trash'></i></button>";

    // Limpia el valor del campo de entrada paradaOculto
    document.getElementById("paradaOculto").value = "";
    // Limpia el valor del campo de entrada selecInput
    document.getElementById("selecInput").value = "";
    selecParada();
    actualizarNumerosParadas();
  }
});

function eliminarFila(botonEliminar) {
  const fila = botonEliminar.closest("tr"); // Obtener la fila del botón
  const tablaParadas = document.getElementById("tablaParadas");
  const filas = tablaParadas.querySelectorAll("tr");

  for (let i = 0; i < filas.length; i++) {
    if (filas[i] === fila) {
      fila.remove();
      break;
    }
  }

  // Actualizar los números de las paradas
  actualizarNumerosParadas();
}

function actualizarNumerosParadas() {
  const tablaParadas = document.getElementById("tablaParadas");
  const filas = tablaParadas.querySelectorAll("tr");

  for (let i = 0; i < filas.length; i++) {
    const numeroParada = filas[i].querySelector("td:first-child");
    numeroParada.innerHTML = i + 1;
  }
}

document
  .getElementById("datosGuardarParada")
  .addEventListener("click", function () {
    const filas = document.querySelectorAll('[id^="newRow"]');
    const arrayIds = new Set(); // conjunto para almacenar los IDs únicos
    const datosGuardadosParadas = []; // arreglo para almacenar los datos
    const inputD = document.getElementById("destinoOculto").value;
    const idRuta = document.getElementById("idRuta").value;

    filas.forEach((fila) => {
      const celdas = fila.querySelectorAll("td");
      if (celdas.length >= 4) {
        const idParada = celdas[3].querySelector("input").value;

        if (!arrayIds.has(idParada)) {
          // Verificar si el ID no está en el conjunto y, si no está, agregarlo y procesar la fila
          arrayIds.add(idParada);
          const numeroParada = celdas[0].textContent;

          // Guardar los datos en el arreglo
          const datosFila = {
            numero: numeroParada,
            id: idParada,
          };

          datosGuardadosParadas.push(datosFila);
        }
      }
    });
    const datosAEnviar = {
      datosGuardadosParadas: datosGuardadosParadas,
      accion: "registrarParadas",
      destino: inputD,
      idRuta: idRuta,
    };
    const url = "logica/logica.php";
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
        console.log(data);
      })
      .catch((error) => {
        console.error("Hubo un error:", error);
      });
  });

//////////////////////////////////////////////
//              mostrar rutas               //
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
      const idRuta = displayedData[i].idRuta.toLowerCase();
      const origen = displayedData[i].origen.toLowerCase();
      const destino = displayedData[i].destino.toLowerCase();
      const precio = displayedData[i].precio.toLowerCase();
      if (
        idRuta.startsWith(searchTerm) ||
        origen.startsWith(searchTerm) ||
        destino.startsWith(searchTerm) ||
        precio.startsWith(searchTerm)
      ) {
        const newRow = table.insertRow(-1);
        const checkboxCell = newRow.insertCell(0); //agrega una nueva celda en la fila
        const idRuta = newRow.insertCell(1);
        const origen = newRow.insertCell(2);
        const destino = newRow.insertCell(3);
        const precio = newRow.insertCell(4);

        checkboxCell.innerHTML =
          "<input onclick='borrarUsuario(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>";
        idRuta.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedDataTP[i].idRuta +
          "'>";
        origen.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedDataTP[i].origen +
          "'>";
        destino.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedDataTP[i].destino +
          "'>";
        precio.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          displayedDataTP[i].precio +
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
    accion: "mostrarRutas",
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

      displayedDataTP = []; // Limpiar los datos almacenados previamente

      // Agregar las filas con los nuevos datos
      for (let i = 0; i < data.length; i++) {
        const newRow = table.insertRow(-1);
        const checkboxCell = newRow.insertCell(0);
        const idRuta = newRow.insertCell(1);
        const origen = newRow.insertCell(2);
        const destino = newRow.insertCell(3);
        const precio = newRow.insertCell(4);

        checkboxCell.innerHTML =
          "<input onclick='borrarRuta(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>";
        idRuta.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].idRecorrido +
          "'>";
        origen.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].coordenadas_origen +
          "'>";
        destino.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].coordenadas_destino +
          "'>";
        precio.innerHTML =
          "<input class='inputTabla' type='text' readonly value='" +
          data[i].precioTotal +
          "'>";

        // Almacenar los datos en displayedDataTP
        displayedDataTP.push({
          idRuta: data[i].idRecorrido,
          origen: data[i].coordenadas_origen,
          destino: data[i].coordenadas_destino,
          precio: data[i].precioTotal,
        });
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}

//////////////////////////////////////////////
//           borrado logico rutas           //
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
    accion: "borrarRutas",
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
      if (data == "Ruta borrada") {
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          parrafoExistente.textContent = "Ruta eliminada"; //agrega el contenido al parrafo
          advertenciaBorrar.appendChild(parrafoExistente); //agrega el parrafo al div
          setTimeout(function () {
            advertenciaBorrar.removeChild(parrafoExistente);
          }, 5000);
          actualizarTabla();
        } else {
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaBorrar"); //agrega la clase al parrafo
          nuevoParrafo.textContent = "Ruta eliminada"; //agrega el contenido al parrafo
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