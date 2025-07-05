import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    //* Referencia al formulario de creación de usuario
    const formUser = document.getElementById("formUser");
    
    //* Asignar evento al guardar el usuario
    formUser.addEventListener("submit", (e) => {
        e.preventDefault(); // Evita la validación del formulario
        userController.save();
    });
   
    //* Asignar evento al cancelar
    const btnCancelarUser = document.getElementById("btnCancelarUser");
    btnCancelarUser.addEventListener("click", (e) => {
        e.preventDefault(); // Evita la validación del formulario
        window.location.href = "index.html";
    });

});
