////////////////////////////////////////////
//            mostrar en modal            //
////////////////////////////////////////////
actualizarTabla();

function actualizarTabla() {

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
      const table = document.getElementById("tableCoche");

      // Limpiar la tabla antes de actualizar
      while (table.rows.length > 1) {
        table.deleteRow(1);
      }

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

        checkboxCell.innerHTML =
          "<input onclick='borrarCoches(); disableOtherChecks(this)' type='checkbox' class='check seleccionarFila'>"; //agrega el contenido a la celda
        CocheCell.innerHTML = data[i].numOmnibus;
        CocheCell.className = "inputTabla";
        MatriculaCell.innerHTML = data[i].matricula;
        MatriculaCell.className = "inputTabla";
        ModeloCell.innerHTML = data[i].modelo;
        ModeloCell.className = "inputTabla";
        MarcaCell.innerHTML = data[i].marca;
        MarcaCell.className = "inputTabla";
        AsientosCell.innerHTML = data[i].cantidadAsientos;
        AsientosCell.className = "inputTabla";
        PisosCell.innerHTML = data[i].pisos;
        PisosCell.className = "inputTabla";
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}


//////////////////////////////////////////////
//              mostrar rutas               //
//////////////////////////////////////////////
actualizarTabla();

function actualizarTabla() {

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
      const table = document.getElementById("tableRuta");

      // Limpiar la tabla antes de actualizar
      while (table.rows.length > 1) {
        table.deleteRow(1);
      }

      // Agregar las filas con los nuevos datos
      for (let i = 0; i < data.length; i++) {
        const newRow = table.insertRow(-1);
        const checkboxCell = newRow.insertCell(0);
        const idRuta = newRow.insertCell(1);
        const origen = newRow.insertCell(2);
        const destino = newRow.insertCell(3);

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
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}