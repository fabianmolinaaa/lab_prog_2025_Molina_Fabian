const API_BASE_URL = "authentication/";

export const service = {
    login: (data) => {
        return fetch(`${API_BASE_URL}login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .catch (error => {
            console.error("Error en la petición", error);
            throw error;
        })
    }
}