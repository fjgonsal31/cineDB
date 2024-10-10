const btnDelete = document.querySelectorAll(".delete");
const btnUpdate = document.querySelectorAll(".update");

// eliminar pelicula
btnDelete.forEach((btn) => {
  btn.addEventListener("click", (event) => {
    if (confirm("¿Eliminar?")) {
      let id = event.currentTarget.id.slice(1);
      let tr = event.currentTarget;

      fetch("includes/controllerPelicula.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `id=${id}&_method=DELETE`, // Enviar el ID y un campo para indicar DELETE al controlador
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error en la solicitud: " + response.status);
          }
          return response.text(); // Recibir la respuesta como texto
        })
        .then((data) => {
          console.log("Respuesta:", data);
          tr.parentElement.parentElement.remove();
        })
        .catch((error) => {
          console.error("Hubo un problema con la solicitud fetch:", error);
        });
    }
  });
});

// editar película
btnUpdate.forEach((btn) => {
  btn.addEventListener("click", (event) => {
    let id = event.currentTarget.id.slice(1);
    let opciones = event.currentTarget.parentElement;
    let btnEditar = event.currentTarget;
    let btnBorrar = event.currentTarget.nextElementSibling;
    let btnAceptar = btnBorrar.nextElementSibling;
    let btnCancelar = btnAceptar.nextElementSibling;
    let director = opciones.previousElementSibling.previousElementSibling;
    let idDirector = opciones.nextElementSibling;
    let tdSelect = document.getElementById("select" + id);
    let select = document.getElementById("directorSelect" + id);
    let precio = director.previousElementSibling;
    let titulo = precio.previousElementSibling;
    let oldTitulo = titulo.innerHTML;
    let oldPrecio = precio.innerHTML;
    let oldDirector = director.innerHTML;

    titulo.innerHTML = `<input type="text" value="${titulo.innerHTML}">`;
    precio.innerHTML = `<input type="text" value="${precio.innerHTML.match(
      /\d+/g
    )}">`;
    director.innerHTML = "";
    tdSelect.classList.remove("hidden");
    select.value = idDirector.innerHTML;
    director.classList.add("hidden");
    btnEditar.classList.add("hidden");
    btnBorrar.classList.add("hidden");
    btnAceptar.classList.remove("hidden");
    btnCancelar.classList.remove("hidden");

    // cancelar
    btnCancelar.addEventListener("click", (event) => {
      titulo.innerHTML = oldTitulo;
      precio.innerHTML = oldPrecio;
      director.innerHTML = oldDirector;
      tdSelect.classList.add("hidden");
      director.classList.remove("hidden");
      btnAceptar.classList.add("hidden");
      btnCancelar.classList.add("hidden");
      btnEditar.classList.remove("hidden");
      btnBorrar.classList.remove("hidden");
    });

    // aceptar
    btnAceptar.addEventListener("click", (event) => {
      let newTitulo = titulo.children[0].value.trim();
      let newPrecio = precio.children[0].value.match(/\d+/g);
      let newIdDirector = select.value;

      let datos = `id=${id}&titulo=${newTitulo}&precio=${newPrecio}&idDirector=${newIdDirector}&_method=UPDATE`;

      fetch("includes/controllerPelicula.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: datos, // Enviar al controlador los datos
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error en la solicitud: " + response.status);
          }
          return response.text(); // Recibir la respuesta como texto
        })
        .then((data) => {
          titulo.innerHTML = newTitulo;
          precio.innerHTML = newPrecio + " €";
          tdSelect.classList.add("hidden");
          director.classList.remove("hidden");
          director.innerHTML = select.options[select.selectedIndex].text;
          idDirector.innerHTML = select.value;
          idDirector.id = "i" + select.value;
          btnAceptar.classList.add("hidden");
          btnCancelar.classList.add("hidden");
          btnEditar.classList.remove("hidden");
          btnBorrar.classList.remove("hidden");
        })
        .catch((error) => {
          console.error("Hubo un problema con la solicitud fetch:", error);
        });
    });
  });
});
