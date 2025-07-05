import { itemController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    /*
     * Obtiene el ID del item desde la URL
     ? Antes usaba esto porque usaba URL relativas.
     ! const id = new URLSearchParams(window.location.search).get("id");
    */
    
    const urlParts = window.location.pathname.split('/');
    const id = urlParts[urlParts.length - 1];

    //* Asigna el item a la variable item
    const item = itemController.load(id);
    
    //* Llenar los campos del formulario
    document.getElementById("name").value = item.name;
    document.getElementById("price").value = item.price;
    document.getElementById("stock").value = item.stock;
    document.getElementById("category").value = item.category;
    document.getElementById("description").value = item.description;

    //* Funcionalidad de los botones */

    //* Asignar evento al editar
    const editButton = document.getElementById("editButton");
    editButton.addEventListener("click", () => {
        itemController.enableForm(true);
    });

    //* Asignar evento al cancelar
    const cancelButton = document.getElementById("cancelButton");
    cancelButton.addEventListener("click", () => {
        itemController.resetForm();
        itemController.enableForm(false);
    });

    //* Asignar evento al guardar
    const saveButton = document.getElementById("saveButton");
    saveButton.addEventListener("click", () => {
        // Actualizar el item
        itemController.update();
    });

    //* Asignar evento al exportar a PDF
    const btnExportarPDF = document.getElementById("btnExportarPDF");
    btnExportarPDF.addEventListener("click", () => {
        itemController.exportToPDF();
    });
});
