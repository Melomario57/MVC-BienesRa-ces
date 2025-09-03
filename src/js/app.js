document.addEventListener("DOMContentLoaded", function () {
  eventListeners();

  darkMode();
});

// Guardar en el localStorage
function elegirModo() {
  if (
    window.matchMedia &&
    window.matchMedia("(prefers-color-scheme: dark)").matches &&
    localStorage.getItem("modo") === "claro"
  ) {
    document.body.classList.remove("dark-mode");
  } else if (
    (window.matchMedia &&
      window.matchMedia("(prefers-color-scheme: dark)").matches) ||
    localStorage.getItem("modo") === "oscuro"
  ) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }
}

function darkMode() {
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)"); // Ver las preferencias del usuario

  // console.log(prefiereDarkMode.matches);

  if (prefiereDarkMode.matches) {
    // Si el usuario prefiere el darkMode cambía automaticamente al cargar el sitio web
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      // Si el usuario prefiere el darkMode cambía automaticamente sin tener que cargar el sitio web(si las cambia desde preferencias)
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const botonDarkMode = document.querySelector(".dark-mode-boton");

  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode"); // Es necesario llamar al body para que todo el sitio se haga negro
    let modo = "claro";

    if (document.body.classList.contains("dark-mode")) {
      modo = "oscuro"; // Para guardar el dark mode en el almacenamiento local, para que esten por default incluso si cambio de página
    } else {
      modo = "claro";
    }
    localStorage.setItem("modo", modo); // Nos permite guardar datos en el navegador(el darkMode se guarda)
  }); // No tiene fecha de eliminación a diferencia de sessionStorage
}

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");

  mobileMenu.addEventListener("click", navegacionResponsive);

  // Muestra campos condicionales
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  metodoContacto.forEach((input) =>
    input.addEventListener("click", mostrarMetodosContacto)
  );
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  navegacion.classList.toggle("mostrar");
}

function mostrarMetodosContacto(e) {
  const contactoDiv = document.querySelector("#contacto");

  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `
            <label for="telefono">Número Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" required />

             <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]" />
            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" />
    `;
  } else {
    contactoDiv.innerHTML = `
    <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required />
            `;
  }
}
