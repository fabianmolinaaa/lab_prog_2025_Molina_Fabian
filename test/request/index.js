let formCategoria = document.forms["formCategoria"];

function save(e){
    e.preventDefault();
    data = {
        nombre: formCategoria.datoNombre.value 
    };
    console.log("Guardando datos..."); 
    fetch ("http://localhost/lab_prog_2025_Molina_Fabian/test/request/requestTest.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=utf-8",
        },
        body: JSON.stringify(data)
    }) 
    .then(response => {
        if (!response.ok) {
            throw new Error(response.status);
        }
        return response.json();
    })
    .then(response => {
        console.log(response);
    })
    .catch(error => {
        console.error("Error de peticion => ",error);
    });    
}
