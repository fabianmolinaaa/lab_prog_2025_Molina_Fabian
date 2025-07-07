import { itemService } from "./service.js";
import * as jspdf from "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js";
import * as jspdfAutotable from "https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js";

//* Referencia a la tabla de usuarios
const tbodyItem = document.getElementById("tbodyItem");

//* Función para actualizar la tabla de usuarios
const updateTable = (items) => {
    if (tbodyItem) {
        tbodyItem.innerHTML = "";
        items.forEach(item => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.codigo}</td>    
                <td>${item.nombre}</td>
                <td>${item.descripcion}</td>
                <td>${item.nombreCategoria}</td>
                <td>${item.precio}</td>
                <td>${item.stock}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-id="${item.id}">Editar</button>
                    <button type="button" class="btn btn-sm btn-danger" data-id="${item.id}">Eliminar</button>
                </td>
            `;
            tbodyItem.appendChild(row);
        });
        // Asignar eventos a los botones de editar y eliminar
        assignBtnEvents();
    }
};

//* Función para asignar funcionalidad a los botones de editar y eliminar
const assignBtnEvents = () => {
    // Asignar funcionalidad a los botones de editar
    const btnEditarItem = document.querySelectorAll(".btn-primary");
    btnEditarItem.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = "item/edit/" + e.target.dataset.id;
        });
    });

    // Asignar funcionalidad a los botones de eliminar
    const btnEliminarItem = document.querySelectorAll(".btn-danger");
    btnEliminarItem.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const itemId = e.target.dataset.id;
            
            if (!itemId) {
                alert("Error: ID de item no encontrado");
                return;
            }
            
            if (confirm("¿Está seguro de que desea eliminar este item?")) {
                try {
                    await itemController.delete(itemId);
                } catch (error) {
                    console.error(error);
                    if (error.message === "ID de item inválido") {
                        alert("Error: ID de item inválido");
                    } else {
                        alert("Error al eliminar el usuario: " + error.message);
                    }
                }
            }
        });
    });
};

//* Almacenar el ID del usuario
let currentItemId = null;

export const itemController = {
    //* Solicita al servicio una cuenta existente y lo muestra en la vista
    load: async id => {
        // Almacenar el ID del usuario
        currentItemId = id;
        if (!currentItemId) {
            alert("Error: ID de item no encontrado");
            return;
        }

        // Solicita al servicio una cuenta existente
        try {
            const itemId = parseInt(currentItemId);
            if (isNaN(itemId)) {
                throw new Error("ID de item inválido");
            }
            
            const item = await itemService.load(itemId);
            if (!item) {
                throw new Error("Item no encontrado");
            }
            
            return item;
        } catch (error) {
            console.error("Error al cargar el item:", error);
            throw error;
        }
    },
    //* Crea una cuenta con los datos de la vista y lo envía al servicio para persistir
    save: () => {
        const formItem = document.getElementById("formItem");
        
        // Validacion de campos
        if(!formItem.checkValidity()){
            formItem.reportValidity();
            return; // Detiene la ejecución si el form no es válido
        }

        // Capturo los datos 
        const itemData = {
            nombre: formItem.nombre.value.trim(),
            precio: formItem.precio.value.trim(),
            stock: formItem.stock.value.trim(),
            categoriaId: formItem.categoria.value,
            descripcion: formItem.descripcion.value.trim(),
            codigo: "EVNT-" + Math.floor(Math.random() * 10000) // Generar código aleatorio
        };

        // Llamo al servicio
        try {
            itemService.save(itemData);
            alert("Item guardado exitosamente");
            formItem.reset();
        } catch (error) {
            console.error(error);
            alert("Error al guardar el item");
        }
    },
    //* Actualiza un item
    update: () => {
        // Obtener el ID del item
        const id = new URLSearchParams(window.location.search).get("id");
        if (!id) {
            alert("Error: ID de item no encontrado");
            return;
        }

        // Obtener datos del formulario
        const itemData = {
            nombre: document.getElementById("nombre").value,
            precio: document.getElementById("precio").value,
            stock: document.getElementById("stock").value,
            categoria: document.getElementById("categoria").value,
            descripcion: document.getElementById("descripcion").value
        };

        // Validar campos
        if (itemData.nombre === "" || itemData.precio === "" || itemData.stock === "" || itemData.categoria === "" || itemData.descripcion === "") {
            alert("Por favor, complete todos los campos");
            return;
        }

        // Actualizar item
        try {
            itemService.update(id, itemData);
            alert("Item actualizado exitosamente");
            itemController.enableForm(false);
        } catch (error) {
            alert("Error al actualizar el item");
        }
    },
    //* Solicita al servicio eliminar un item existente y actualizar la vista
    delete: async id => {
        try {
            // Validar que el ID sea un número válido
            const itemId = parseInt(id);
            if (isNaN(itemId)) {
                throw new Error("ID de item inválido");
            }
            
            const success = await itemService.delete(itemId);
            if (!success) {
                throw new Error("No se pudo eliminar el item");
            }
            
            // Actualizar la vista
            updateTable(await itemService.list());
            alert("Item eliminado exitosamente");
            return true;
        } catch (error) {
            console.error("Error al eliminar el item:", error);
            throw error;
        }
    },
    //* Solicita al servicio las cuentas existentes y las muestra en la vista
    list: async () => {
        try {
            const items = await itemService.list();
            updateTable(items);
        } catch (error) {
            console.error("Error al mostrar items:", error);
            throw error;
        }
    },
    //* Genera un archivo PDF
    exportToPDF: async () => {
        try {
            // Obtener los datos de los items
            const items = await itemService.list();
            
            // Verificar si jsPDF está disponible
            if (typeof window.jspdf === 'undefined' || typeof window.jspdf.jsPDF === 'undefined') {
                throw new Error("La biblioteca jsPDF no está cargada correctamente");
            }

            // Crear un nuevo documento PDF
            const doc = new window.jspdf.jsPDF();

            // Agregar título
            doc.setFontSize(16);
            doc.text("Listado de Items", 10, 10);

            // Definir columnas para la tabla
            const columns = [
                { header: 'Código', dataKey: 'codigo' },
                { header: 'Nombre', dataKey: 'nombre' },
                { header: 'Descripción', dataKey: 'descripcion' },
                { header: 'Categoría', dataKey: 'categoriaId' },
                { header: 'Precio', dataKey: 'precio' },
                { header: 'Stock', dataKey: 'stock' }
            ];

            // Formatear los datos para la tabla
            const rows = items.map(item => ({
                ...item,
                precio: `$${item.precio}`
            }));

            // Generar la tabla
            doc.autoTable({
                columns,
                body: rows,
                startY: 20,
                theme: 'grid',
                headStyles: {
                    fillColor: [41, 41, 41],
                    textColor: 255
                },
                styles: {
                    fontSize: 9,
                    cellPadding: 2
                }
            });

            // Guardar el PDF
            doc.save('listado-items.pdf');

        } catch (error) {
            console.error("Error al generar el PDF:", error);
            alert("Error al generar el PDF: " + error.message);
        }
    },
    //* Resetea el formulario con los datos originales del usuario
    resetForm: () => {
        if (!currentItemId) {
            console.error("ID de item no almacenado");
            return;
        }

        // Cargar los datos originales del usuario
        const item = itemService.load(currentItemId);
        if (!item) {
            console.error("Item no encontrado");
            return;
        }

        // Restaurar los valores originales
        document.getElementById("nombre").value = item.nombre;
        document.getElementById("precio").value = item.precio;
        document.getElementById("categoria").value = item.categoria;
        document.getElementById("stock").value = item.stock;
        document.getElementById("descripcion").value = item.descripcion;
    },
    //* Habilita o deshabilita todos los controles del formulario de la vista
    enableForm: (boolean) => {
        if (boolean) {
            document.getElementById("nombre").removeAttribute("disabled");
            document.getElementById("precio").removeAttribute("disabled");
            document.getElementById("categoria").removeAttribute("disabled");
            document.getElementById("stock").removeAttribute("disabled");
            document.getElementById("descripcion").removeAttribute("disabled");
        } else {
            document.getElementById("nombre").setAttribute("disabled", "disabled");
            document.getElementById("precio").setAttribute("disabled", "disabled");
            document.getElementById("categoria").setAttribute("disabled", "disabled");
            document.getElementById("stock").setAttribute("disabled", "disabled");
            document.getElementById("descripcion").setAttribute("disabled", "disabled");
        }
    }
}