document.getElementById("formulario").addEventListener("submit", function(e) {
  e.preventDefault();

  const advertenciaForm = document.getElementById("advertenciaForm");
  const elementoAdvertencia = document.querySelector(".advertenciaForm");

  const usuario = document.getElementById("usuario").value;
  const password = document.getElementById("password").value;
  
  //guardar el parrafo en caso de que exista
  const parrafoExistente = advertenciaForm.querySelector("p");
  
  const url = "controlador/controladorLogin.php";

  // Crear un objeto JavaScript con los valores
  const datosAEnviar = {
    usuario: usuario,
    password:password,
    accion: "login",
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
      if (data == "usuario encontrado"){
        window.location="usuarios.php";
      }
      else if (data == "usuario encontrado 2"){
        window.location="rutas.php";
      }
      else{
        if (parrafoExistente) {
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          parrafoExistente.classList.add("advertenciaForm"); //agrega la clase al parrafo
          parrafoExistente.textContent = 'usuario o contraseña incorrecta'; //agrega el contenido al parrafo
          advertenciaForm.appendChild(parrafoExistente); //agrega el parrafo al div
        }else{
          const nuevoParrafo = document.createElement("p"); //crea un nuevo parrafo para mostrar la advertencia 
          elementoAdvertencia.style.color = "var(--semantico-rojo)"; //agrega el color a usar en la clase del parrafo
          nuevoParrafo.classList.add("advertenciaForm"); //agrega la clase al parrafo
          nuevoParrafo.textContent = 'usuario o contraseña incorrecta'; //agrega el contenido al parrafo
          advertenciaForm.appendChild(nuevoParrafo); //agrega el parrafo al div
        }
      }
    })
    .catch((error) => {
      console.error("Hubo un error:", error);
    });
});