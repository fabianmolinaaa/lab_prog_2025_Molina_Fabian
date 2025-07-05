import { itemController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    //* Referencia al formulario de creación de usuario
    const formItem = document.getElementById("formItem");
    
    //* Asignar evento al guardar el usuario
    formItem.addEventListener("submit", (e) => {
        e.preventDefault(); // Evita la validación del formulario
        itemController.save();
    });
   
    //* Asignar evento al cancelar
    const btnCancelarItem = document.getElementById("btnCancelarItem");
    btnCancelarItem.addEventListener("click", (e) => {
        e.preventDefault(); // Evita la validación del formulario
        window.location.href = "index.html";
    });

});
