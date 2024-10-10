const btnEnviar = document.getElementById("enviar");
const btnCancelar = document.getElementById("volver");
const titulo = document.getElementById("titulo");
const precio = document.getElementById("precio");
const idDirector = document.getElementById("idDirector");
const formDiv = document.getElementById("formDiv");
const form = document.getElementById("form");

btnCancelar.addEventListener("click", () => {
  formDiv.style.display = "none";
  titulo.value = "";
  precio.value = "";
  idDirector.value = "0";
  window.location.href = "index.php";
});