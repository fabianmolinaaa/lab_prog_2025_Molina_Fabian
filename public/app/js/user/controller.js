import { userService } from "./service.js";

//* Referencia a la tabla de usuarios
const tbodyUser = document.getElementById("tbodyUser");

//* Función para actualizar la tabla de usuarios
const updateTable = (users) => {
    if (tbodyUser) {
        tbodyUser.innerHTML = "";
        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.name} ${user.lastName}</td>
                <td>${user.cuenta}</td>
                <td>${user.perfil}</td>
                <td>${user.email}</td>
                <td>${user.tel}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-id="${user.id}">Editar</button>
                    <button type="button" class="btn btn-sm btn-danger" data-id="${user.id}">Eliminar</button>
                </td>
            `;
            tbodyUser.appendChild(row);
        });
        // Asignar eventos a los botones de editar y eliminar
        assignBtnEvents();
    }
};

//* Función para asignar funcionalidad a los botones de editar y eliminar
const assignBtnEvents = () => {
    // Asignar funcionalidad a los botones de editar
    const btnEditarUser = document.querySelectorAll(".btn-primary");
    btnEditarUser.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = "/lab_prog_2025_Molina_Fabian/public/user/edit/" + e.target.dataset.id;
        });
    });

    // Asignar funcionalidad a los botones de eliminar
    const btnEliminarUser = document.querySelectorAll(".btn-danger");
    btnEliminarUser.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            const userId = e.target.dataset.id;
            
            if (!userId) {
                alert("Error: ID de usuario no encontrado");
                return;
            }
            
            if (confirm("¿Está seguro de que desea eliminar este usuario?")) {
                try {
                    userController.delete(userId);
                } catch (error) {
                    console.error(error);
                    if (error.message === "ID de usuario inválido") {
                        alert("Error: ID de usuario inválido");
                    } else {
                        alert("Error al eliminar el usuario: " + error.message);
                    }
                }
            }
        });
    });
};

//* Almacenar el ID del usuario
let currentUserId = null;

export const userController = {
    //* Solicita al servicio una cuenta existente y lo muestra en la vista
    load: id => {
        // Almacenar el ID del usuario
        currentUserId = id;
        if (!currentUserId) {
            alert("Error: ID de usuario no encontrado");
            return;
        }

        // Solicita al servicio una cuenta existente
        try {
            const userId = parseInt(currentUserId);
            if (isNaN(userId)) {
                throw new Error("ID de usuario inválido");
            }
            
            const user = userService.load(userId);
            if (!user) {
                throw new Error("Usuario no encontrado");
            }
            
            return user;
        } catch (error) {
            console.error("Error al cargar el usuario:", error);
            throw error;
        }
    },
    //* Crea una cuenta con los datos de la vista y lo envía al servicio para persistir
    save: () => {
        const formUser = document.getElementById("formUser");
        
        // Validacion de campos
        if(!formUser.checkValidity()){
            formUser.reportValidity();
            return; // Detiene la ejecución si el form no es válido
        }

        // Validacion de contraseñas
        if(formUser.password.value !== formUser.confirmPassword.value){
            alert("Las contraseñas no coinciden");
            return;
        }

        // Capturo los datos 
        const userData = {
            nombre: formUser.nombre.value.trim(),
            apellido: formUser.apellido.value.trim(),
            cuenta: formUser.cuenta.value.trim(),
            perfil: formUser.perfil.value,
            correo: formUser.correo.value.trim(),
            contraseña: formUser.password.value,
            confirmarContraseña: formUser.confirmPassword.value
        }

        // Llamo al servicio
        try {
            userService.save(userData);
            alert("Usuario guardado exitosamente");
            formUser.reset();
        } catch (error) {
            console.error(error);
            alert("Error al guardar el usuario");
        }
    },
    //* Actualiza una cuenta de usuario
    update: () => {
        // Obtener el ID del usuario
        const id = new URLSearchParams(window.location.search).get("id");
        if (!id) {
            alert("Error: ID de usuario no encontrado");
            return;
        }

        // Obtener datos del formulario
        const userData = {
            name: document.getElementById("name").value,
            lastName: document.getElementById("lastName").value,
            cuenta: document.getElementById("cuenta").value,
            perfil: document.getElementById("perfil").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            confirmPassword: document.getElementById("confirmPassword").value
        };

        // Validar campos
        if (userData.name === "" || userData.lastName === "" || userData.cuenta === "" || userData.perfil === "" || userData.email === "" || userData.password === "" || userData.confirmPassword === "") {
            alert("Por favor, complete todos los campos");
            return;
        }

        // Validar contraseñas
        if (userData.password !== userData.confirmPassword) {
            alert("Las contraseñas no coinciden");
            return;
        }

        // Actualizar usuario
        try {
            userService.update(id, userData);
            alert("Usuario actualizado exitosamente");
            userController.enableForm(false);
        } catch (error) {
            alert("Error al actualizar el usuario");
        }
    },
    //* Solicita al servicio eliminar una cuenta existente y actualizar la vista
    delete: id => {
        try {
            // Validar que el ID sea un número válido
            const userId = parseInt(id);
            if (isNaN(userId)) {
                throw new Error("ID de usuario inválido");
            }
            
            const success = userService.delete(userId);
            if (!success) {
                throw new Error("No se pudo eliminar el usuario");
            }
            
            // Actualizar la vista
            updateTable(userService.list());
            alert("Usuario eliminado exitosamente");
            return true;
        } catch (error) {
            console.error("Error al eliminar el usuario:", error);
            throw error;
        }
    },
    //* Solicita al servicio las cuentas existentes y las muestra en la vista
    list: () => {
        updateTable(userService.list());
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
        const userData = {
            name: document.getElementById("name").value,
            lastName: document.getElementById("lastName").value,
            cuenta: document.getElementById("cuenta").value,
            perfil: document.getElementById("perfil").value,
            email: document.getElementById("email").value,
        };

        // Verificar si todos los datos están presentes
        if (!userData.name || !userData.lastName || !userData.cuenta || !userData.perfil || !userData.email) {
            alert("Error: No se pudieron obtener los datos del formulario");
            return;
        }

        // Titulo del documento
        doc.setFontSize(16);
        doc.text("Datos del Usuario", 105, 20, { align: 'center' });

        // Generar la tabla con los datos del usuario
        doc.autoTable({
            head: [["Campo", "Valor"]],
            body: [
                ["Nombre", userData.name],
                ["Apellido", userData.lastName],
                ["Cuenta", userData.cuenta],
                ["Perfil", userData.perfil],
                ["Correo", userData.email],
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

        // Guardar el PDF con el nombre del usuario
        doc.save(`${userData.name}_${userData.lastName}.pdf`);
    },
    //* Resetea el formulario con los datos originales del usuario
    resetForm: () => {
        if (!currentUserId) {
            console.error("ID de usuario no almacenado");
            return;
        }

        // Cargar los datos originales del usuario
        const user = userService.load(currentUserId);
        if (!user) {
            console.error("Usuario no encontrado");
            return;
        }

        // Restaurar los valores originales
        document.getElementById("name").value = user.name;
        document.getElementById("lastName").value = user.lastName;
        document.getElementById("cuenta").value = user.cuenta;
        document.getElementById("perfil").value = user.perfil;
        document.getElementById("email").value = user.email;
        document.getElementById("password").value = user.password;
        document.getElementById("confirmPassword").value = user.password;
    },
    //* Habilita o deshabilita todos los controles del formulario de la vista
    enableForm: (boolean) => {
        if (boolean) {
            document.getElementById("name").removeAttribute("disabled");
            document.getElementById("lastName").removeAttribute("disabled");
            document.getElementById("cuenta").removeAttribute("disabled");
            document.getElementById("perfil").removeAttribute("disabled");
            document.getElementById("email").removeAttribute("disabled");
            document.getElementById("password").removeAttribute("disabled");
            document.getElementById("confirmPassword").removeAttribute("disabled");
        } else {
            document.getElementById("name").setAttribute("disabled", "disabled");
            document.getElementById("lastName").setAttribute("disabled", "disabled");
            document.getElementById("cuenta").setAttribute("disabled", "disabled");
            document.getElementById("perfil").setAttribute("disabled", "disabled");
            document.getElementById("email").setAttribute("disabled", "disabled");
            document.getElementById("password").setAttribute("disabled", "disabled");
            document.getElementById("confirmPassword").setAttribute("disabled", "disabled");
        }
    }
}