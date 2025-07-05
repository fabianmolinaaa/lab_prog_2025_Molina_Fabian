<!-- BreadCrumb -->
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>

<div class="alta-container">
    <div id="title-container">
        <h1>Editar evento</h1>
        <div>
            <button id="deleteBtn" type="button" class="btn btn-danger">Eliminar registro</button>
            <button id="btnExportarPDF" type="button" class="btn btn-light">Exportar a PDF</button>
        </div>
    </div>
    <div class="form-container">
        <div id="form-title-container">
            <p>Edite los campos que desee modificar:</p>
        </div>
        <form action="" autocomplete="off">
            <input id="name" type="text" placeholder="Nombre" disabled>
            <input id="price" type="number" placeholder="Precio" disabled>
            <select id="category" name="category" disabled>
                <option value="" disabled selected>Categoria</option>
                <option value="presencial">Presencial</option>
                <option value="online">Online</option>
            </select>
            <input id="stock" type="number" placeholder="Cantidad de Entradas" disabled>
            <textarea id="description" placeholder="Descripción" disabled></textarea>
            <div class="botones-container">
                <button id="editButton" type="button" class="btn btn-primary">Editar</button>
                <button id="saveButton" type="button" class="btn btn-success">Guardar</button>
                <button id="cancelButton" type="button" class="btn btn-danger">Cancelar</button>
                <a href="/lab_prog_2025_Molina_Fabian/public/item" class="btn btn-secondary">Listado</a>
            </div>
        </form>
    </div>
</div>