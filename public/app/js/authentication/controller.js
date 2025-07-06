import { service } from "./service.js";
import { showModal } from "../components/modal.js";

export const controller = {
    login: (account, password) => {
        const dataAccount = { account, password }
        service.login(dataAccount)
            .then(response => {
                if (response.error === "" && response.message === "OK") {
                    window.location.href = "home";
                }
                else {
                    showModal({
                        title: "Acceso denegado",
                        message: response.error || "Credenciales inválidas.",
                        type: "error"
                    });
                }
            })
            .catch(error => {
                showModal({
                    title: "Error de conexión",
                    message: error.message || "No se pudo conectar con el servidor.",
                    type: "error"
                });
            })
    }
}