const API_BASE_URL = "item/";
//* Exportar el servicio
export const itemService = {
    //* Devuelve el item que se corresponda con el identificador
    load: id => {
        const pos = items.findIndex(item => item.id === parseInt(id))
        return items[pos] // Devuelve un objeto item 
    },
    //* Guarda un nuevo item
    save: item => {
        item.id = items.length + 1; 
        items.push(item);
    },
    //* Actualiza un item
    update: (id, itemData) => {
        // Buscar el item por ID
        const itemIndex = items.findIndex(item => item.id === parseInt(id));
        
        if (itemIndex === -1) {
            console.error(`Item no encontrado con ID: ${id}`);
            return null;
        }

        // Actualizar el item
        items[itemIndex].name = itemData.name;
        items[itemIndex].code = itemData.code;
        items[itemIndex].description = itemData.description;
        items[itemIndex].category = itemData.category;
        items[itemIndex].price = itemData.price;
        items[itemIndex].stock = itemData.stock;

        // Retornar el item actualizado
        return items[itemIndex];
    },
    //* Elimina un item existente
    delete: id => {
        try {
            const index = items.findIndex(item => item.id === parseInt(id));
            if (index !== -1) {
                items.splice(index, 1); // Elimina el item del array en ese índice
                return true;
            }
            return false; // No se encontró el item
        } catch (error) {
            console.error("Error al eliminar item:", error);
            throw error;
        }
    },
    //* Devuelve todos los items
    list: () => {
        return fetch(`${API_BASE_URL}list`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error("Error al mostrar items:", error);
            throw error;
        });
    }
}