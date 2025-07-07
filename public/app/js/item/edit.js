
import { itemController } from "./controller.js";

document.addEventListener("DOMContentLoaded", async () => {
    
    const urlParts = window.location.pathname.split('/');
    const id = urlParts[urlParts.length - 1];

    //* Asigna el item a la variable item
    const item = await itemController.load(id);
    const itemData = item.result;
        
    
    //* Llenar los campos del formulario
    document.getElementById("name").value = itemData.nombre;
    document.getElementById("price").value = itemData.precio;
    document.getElementById("stock").value = itemData.stock;
    document.getElementById("category").value = itemData.categoria;
    document.getElementById("description").value = itemData.descripcion;

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
