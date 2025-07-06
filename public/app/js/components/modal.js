export function showModal(data) {
    const modalElement = document.getElementById("modal");
    const modalTitle = modalElement.querySelector("#modal-title");
    const modalMessage = modalElement.querySelector("#modal-message");
    const iconContainer = modalElement.querySelector("#modal-icon-container");

    // Mapeo de tipo → emoji + clase de color
    const typeMap = {
        success: { emoji: "✅", color: "text-success" },
        error: { emoji: "❌", color: "text-danger" },
        warning: { emoji: "⚠️", color: "text-warning" },
        info: { emoji: "ℹ️", color: "text-primary" },
    };

    const type = typeMap[data.type] || typeMap.info;

    // Insertar emoji y color
    iconContainer.textContent = type.emoji;
    iconContainer.className = `me-2 fs-4 ${type.color}`;

    // Setear contenido
    modalTitle.textContent = data.title || "Mensaje";
    modalMessage.textContent = data.message || "";

    // Mostrar el modal usando Bootstrap
    const bootstrapModal = new bootstrap.Modal(modalElement);
    bootstrapModal.show();
}

