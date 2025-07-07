import { itemController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    // Inicializar la tabla
    itemController.list();
    
    //* Asignar evento al exportar a PDF
    const btnExportarPDF = document.getElementById("btnExportarPDF");
    btnExportarPDF.addEventListener("click", () => {
        itemController.exportToPDF();
    });
});
