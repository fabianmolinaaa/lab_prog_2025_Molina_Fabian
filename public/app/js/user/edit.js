import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    /*
     * Obtiene el ID del usuario desde la URL
     ? Antes usaba esto porque usaba URL relativas.
     ! const id = new URLSearchParams(window.location.search).get("id");
    */
    
    const urlParts = window.location.pathname.split('/');
    const id = urlParts[urlParts.length - 1];

    //* Asigna el usuario a la variable user
    const user = userController.load(id);
    
    //* Llenar los campos del formulario
    document.getElementById("name").value = user.name;
    document.getElementById("lastName").value = user.lastName;
    document.getElementById("cuenta").value = user.cuenta;
    document.getElementById("perfil").value = user.perfil;
    document.getElementById("email").value = user.email;
    document.getElementById("password").value = user.password;
    document.getElementById("confirmPassword").value = user.password;

    //* Funcionalidad de los botones */

    //* Asignar evento al editar
    const editButton = document.getElementById("editButton");
    editButton.addEventListener("click", () => {
        userController.enableForm(true);
    });

    //* Asignar evento al cancelar
    const cancelButton = document.getElementById("cancelButton");
    cancelButton.addEventListener("click", () => {
        userController.resetForm();
        userController.enableForm(false);
    });

    //* Asignar evento al guardar
    const saveButton = document.getElementById("saveButton");
    saveButton.addEventListener("click", () => {
        // Actualizar el usuario
        userController.update();
    });

    //* Asignar evento al exportar a PDF
    const btnExportarPDF = document.getElementById("btnExportarPDF");
    btnExportarPDF.addEventListener("click", () => {
        userController.exportToPDF();
    });
});
