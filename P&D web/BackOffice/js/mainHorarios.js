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
  // Selecciona todos los elementos input dentro del modal
  const inputs = document.querySelectorAll("#modalAgregar input");

  // Establece el valor de cada input en una cadena vacía
  inputs.forEach((input) => {
    input.value = "";
  });
});

// Comprobar si el dato de sesión existe
if (userComun !== '') {
  // Utilizar el valor almacenado en la sesión
  console.log('Nombre de usuario: ' + userComun);
  document.getElementById('pUsuario').style.display = 'none';
}


// Obtén una referencia al botón y al input
const botones = document.querySelectorAll('[id^="botonCoche"]');
const input = document.getElementById('selecInput');
const contenido = document.querySelector(".dropdownContenido");

input.addEventListener("click", function() {
  // Muestra el contenido del menú desplegable cuando se hace clic en el input
  contenido.style.display = "block";
});

document.addEventListener("click", function(e) {
  if (e.target !== input && !contenido.contains(e.target)) {
    // Oculta el contenido del menú desplegable cuando se hace clic en cualquier otro lugar
    contenido.style.display = "none";
  }
});

