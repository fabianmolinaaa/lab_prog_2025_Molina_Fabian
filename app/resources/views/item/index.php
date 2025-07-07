<!-- BreadCrumb -->
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eventos</li>
    </ol>
</nav>

<div class="user-container">
    <div class="user-title">
        <h1>Eventos</h1>
    </div>
    <!--* Agregar funcionalidad de filtros -->
    <div class="filtro-container">
        <label for="">Filtros</label>
        <div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Precio</span>
                <input type="number" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm" min="0" max="1000000">
            </div>
            <select class="form-select form-select-sm" aria-label="Small select example">
                <option selected disabled>Categoria</option>
                <option value="todos">Todos</option>
                <option value="presencial">Presencial</option>
                <option value="online">Online</option>
            </select>
            <button type="button" class="btn btn-outline-light btn-sm">Filtrar</button>
        </div>
    </div>
    <div class="user-buttons">
        <a class="btn btn-success" href="/lab_prog_2025_Molina_Fabian/public/item/create" role="button">Alta Evento</a>
        <button id="btnExportarPDF" type="button" class="btn btn-secondary">Exportar listado</button>
    </div>
</div>
<div class="table-container">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tbodyItem"></tbody>
    </table>
</div>