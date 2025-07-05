import { itemService } from "./service.js";

//* Referencia a la tabla de usuarios
const tbodyItem = document.getElementById("tbodyItem");

//* Función para actualizar la tabla de usuarios
const updateTable = (items) => {
    if (tbodyItem) {
        tbodyItem.innerHTML = "";
        items.forEach(item => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.code}</td>    
                <td>${item.name}</td>
                <td>${item.description}</td>
                <td>${item.category}</td>
                <td>${item.price}</td>
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
            window.location.href = "/lab_prog_2025_Molina_Fabian/public/item/edit/" + e.target.dataset.id;
        });
    });

    // Asignar funcionalidad a los botones de eliminar
    const btnEliminarItem = document.querySelectorAll(".btn-danger");
    btnEliminarItem.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            const itemId = e.target.dataset.id;
            
            if (!itemId) {
                alert("Error: ID de item no encontrado");
                return;
            }
            
            if (confirm("¿Está seguro de que desea eliminar este item?")) {
                try {
                    itemController.delete(itemId);
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
    load: id => {
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
            
            const item = itemService.load(itemId);
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
            name: formItem.name.value.trim(),
            price: formItem.price.value.trim(),
            stock: formItem.stock.value.trim(),
            category: formItem.category.value,
            description: formItem.description.value.trim()
        }

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
            name: document.getElementById("name").value,
            price: document.getElementById("price").value,
            stock: document.getElementById("stock").value,
            category: document.getElementById("category").value,
            description: document.getElementById("description").value
        };

        // Validar campos
        if (itemData.name === "" || itemData.price === "" || itemData.stock === "" || itemData.category === "" || itemData.description === "") {
            alert("Por favor, complete todos los campos");
            return;
        }

        // Actualizar usuario
        try {
            itemService.update(id, itemData);
            alert("Item actualizado exitosamente");
            itemController.enableForm(false);
        } catch (error) {
            alert("Error al actualizar el item");
        }
    },
    //* Solicita al servicio eliminar una cuenta existente y actualizar la vista
    delete: id => {
        try {
            // Validar que el ID sea un número válido
            const itemId = parseInt(id);
            if (isNaN(itemId)) {
                throw new Error("ID de item inválido");
            }
            
            const success = itemService.delete(itemId);
            if (!success) {
                throw new Error("No se pudo eliminar el item");
            }
            
            // Actualizar la vista
            updateTable(itemService.list());
            alert("Item eliminado exitosamente");
            return true;
        } catch (error) {
            console.error("Error al eliminar el item:", error);
            throw error;
        }
    },
    //* Solicita al servicio las cuentas existentes y las muestra en la vista
    list: () => {
        updateTable(itemService.list());
    },
    //* Genera un archivo PDF
    exportToPDF: () => {
        // Verificar si jsPDF está disponible
        if (typeof window.jspdf === 'undefined' || typeof window.jspdf.jsPDF === 'undefined') {
            alert("Error: La biblioteca jsPDF no está cargada correctamente. Por favor, recargue la página.");
            console.error('jsPDF no está disponible');
            return;
        }

        // Genera un archivo PDF
        const doc = new window.jspdf.jsPDF();

        // Verificar si el documento se creó correctamente
        if (!doc) {
            alert("Error: No se pudo crear el documento PDF");
            console.error('No se pudo crear el documento PDF');
            return;
        }

        // Obtener los datos del formulario
        const itemData = {
            name: document.getElementById("name").value,
            price: document.getElementById("price").value,
            stock: document.getElementById("stock").value,
            category: document.getElementById("category").value,
            description: document.getElementById("description").value,
        };

        // Verificar si todos los datos están presentes
        if (!itemData.name || !itemData.price || !itemData.stock || !itemData.category || !itemData.description) {
            alert("Error: No se pudieron obtener los datos del formulario");
            return;
        }

        // Titulo del documento
        doc.setFontSize(16);
        doc.text("Datos del Item", 105, 20, { align: 'center' });

        // Generar la tabla con los datos del usuario
        doc.autoTable({
            head: [["Campo", "Valor"]],
            body: [
                ["Nombre", itemData.name],
                ["Precio", itemData.price],
                ["Stock", itemData.stock],
                ["Categoria", itemData.category],
                ["Descripcion", itemData.description],
            ],
            styles: {
                fontSize: 10,
                cellPadding: 2,
                halign: 'left'
            },
            headStyles: {
                fillColor: [76, 175, 80],
                textColor: 255,
                fontStyle: 'bold'
            }
        });

        // Fecha de Generación
        doc.setFontSize(10);
        doc.text("Fecha de generación: " + new Date().toLocaleDateString(), 105, 280, { align: 'center' });

        // Guardar el PDF con el nombre del Item
        doc.save(`${itemData.name}.pdf`);
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
        document.getElementById("name").value = item.name;
        document.getElementById("price").value = item.price;
        document.getElementById("category").value = item.category;
        document.getElementById("stock").value = item.stock;
        document.getElementById("description").value = item.description;
    },
    //* Habilita o deshabilita todos los controles del formulario de la vista
    enableForm: (boolean) => {
        if (boolean) {
            document.getElementById("name").removeAttribute("disabled");
            document.getElementById("price").removeAttribute("disabled");
            document.getElementById("category").removeAttribute("disabled");
            document.getElementById("stock").removeAttribute("disabled");
            document.getElementById("description").removeAttribute("disabled");
        } else {
            document.getElementById("name").setAttribute("disabled", "disabled");
            document.getElementById("price").setAttribute("disabled", "disabled");
            document.getElementById("category").setAttribute("disabled", "disabled");
            document.getElementById("stock").setAttribute("disabled", "disabled");
            document.getElementById("description").setAttribute("disabled", "disabled");
        }
    }
}