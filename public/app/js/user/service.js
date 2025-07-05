const users = [
    {id: 1, name: "Jony", lastName: "Cristaldo", cuenta: "jony.cristaldo", perfil: "admin", email: "jonycris@example.com", tel: "123456789", password: "password"}, 
    {id: 2, name: "Pablo", lastName: "Emilio", cuenta: "pablo.emilio", perfil: "user", email: "pablo.emilio@example.com", tel: "123456789", password: "password"}, 
    {id: 3, name: "Oscar", lastName: "Fabian", cuenta: "oscar.fabian", perfil: "admin", email: "oscar.fabian@example.com", tel: "123456789", password: "password"}, 
    {id: 4, name: "Juan", lastName: "Carlos", cuenta: "juan.carlos", perfil: "user", email: "juan.carlos@example.com", tel: "123456789", password: "password"}, 
    {id: 5, name: "Pedro", lastName: "Ramirez", cuenta: "pedro.ramirez", perfil: "admin", email: "pedro.ramirez@example.com", tel: "123456789", password: "password"}, 
    {id: 6, name: "Luisa", lastName: "Martinez", cuenta: "luisa.martinez", perfil: "user", email: "luisa.martinez@example.com", tel: "123456789", password: "password"}, 
    {id: 7, name: "Ana", lastName: "Gonzalez", cuenta: "ana.gonzalez", perfil: "admin", email: "ana.gonzalez@example.com", tel: "123456789", password: "password"}, 
    {id: 8, name: "Maria", lastName: "Rodriguez", cuenta: "maria.rodriguez", perfil: "user", email: "maria.rodriguez@example.com", tel: "123456789", password: "password"}, 
    {id: 9, name: "Anabel", lastName: "Marquez", cuenta: "anabel", perfil: "user", email: "anabel@example.com", tel: "123456789", password: "password"}, 
    {id: 10, name: "Florencia", lastName: "Marquez", cuenta: "florencia", perfil: "admin", email: "florencia@example.com", tel: "123456789", password: "password"}, 
];

//* Exportar el servicio
export const userService = {
    //* Devuelve la cuenta que se corresponda con el identificador
    load: id => {
        const pos = users.findIndex(user => user.id === parseInt(id))
        return users[pos] // Devuelve un objeto usuario 
    },
    //* Guarda una nueva cuenta de usuario
    save: user => {
        user.id = users.length + 1; 
        users.push(user);
    },
    //* Actualiza una cuenta de usuario
    update: (id, userData) => {
        // Buscar el usuario por ID
        const userIndex = users.findIndex(user => user.id === parseInt(id));
        
        if (userIndex === -1) {
            console.error(`Usuario no encontrado con ID: ${id}`);
            return null;
        }

        // Actualizar el usuario
        users[userIndex].name = userData.name;
        users[userIndex].lastName = userData.lastName;
        users[userIndex].cuenta = userData.cuenta;
        users[userIndex].perfil = userData.perfil;
        users[userIndex].email = userData.email;
        users[userIndex].password = userData.password;

        // Retornar el usuario actualizado
        return users[userIndex];
    },
    //* Elimina una cuenta existente
    delete: id => {
        try {
            const index = users.findIndex(user => user.id === parseInt(id));
            if (index !== -1) {
                users.splice(index, 1); // Elimina el usuario del array en ese índice
                return true;
            }
            return false; // No se encontró el usuario
        } catch (error) {
            console.error("Error al eliminar usuario:", error);
            throw error;
        }
    },
    //* Devuelve todas las cuentas
    list: () => {
        return users;
    }
}