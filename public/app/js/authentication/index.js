import { controller } from './controller.js';
import { showModal } from "../components/modal.js";

const currentModule = "authentication";

document.addEventListener("DOMContentLoaded", () => {
    const btnLogin = document.getElementById("btn-login");
    if (btnLogin) {
        btnLogin.addEventListener("click", () => {
            const account = document.getElementById("email-login").value;
            const password = document.getElementById("password-login").value;

            if (account === "" || password === "") {
                showModal({
                    title: "Campos requeridos",
                    message: "Por favor, complete todos los campos.",
                    type: "warning"
                });
                return;
            }

            controller.login(account, password);
        });
    }
});