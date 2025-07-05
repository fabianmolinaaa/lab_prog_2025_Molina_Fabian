const items = [
    {id: 1, name: "Shakira", code: "e001", description: "Shakira se presenta en vivo", category: "presencial", price: 120000.00, stock: 1500},
    {id: 2, name: "Feid", code: "e002", description: "Feid se presenta en vivo", category: "presencial", price: 100000.00, stock: 1300},
    {id: 3, name: "Maluma", code: "e003", description: "Maluma se presenta en vivo", category: "presencial", price: 110000.00, stock: 1400},
    {id: 4, name: "J balvin", code: "e004", description: "J balvin se presenta en vivo", category: "presencial", price: 130000.00, stock: 1500},
    {id: 5, name: "Karol G", code: "e005", description: "Karol G se presenta en vivo", category: "presencial", price: 140000.00, stock: 1600},
    {id: 6, name: "El Doctor", code: "e006", description: "El Doctor se presenta en vivo", category: "online", price: 7000.00, stock: 150},
];

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
        return items;
    }
}