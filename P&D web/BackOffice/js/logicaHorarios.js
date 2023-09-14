selecCoche();
function selecCoche() {
  const url = "conexion/conexionHorarios.php";

  const datosAEnviar = {
    accion: "mostrarCoche",
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
      const seleccionarCoche = document.getElementById("seleccionarCoche");

      // Agregar las filas con los nuevos datos
      for (let i = 0; i < data.length; i++) {
        const button = document.createElement("button");
        button.type = "button";
        button.id = "botonCoche" + i;
        button.textContent = data[i].matricula;
        seleccionarCoche.appendChild(button);
      }

      // Agregar los manejadores de eventos después de crear los botones
      const botones = document.querySelectorAll('[id^="botonCoche"]');
      const input = document.getElementById("selecInput");
      const contenido = document.querySelector(".dropdownContenido");

      botones.forEach(function (boton) {
        boton.addEventListener("click", function () {
          // Asigna el valor del botón al campo de entrada
          input.value = boton.textContent;
          // Oculta el contenido del menú desplegable
          contenido.style.display = "none";
        });
      });
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
}
