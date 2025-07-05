<!-- BreadCrumb -->
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>

<div class="user-container">
    <div class="user-title">
        <h1>Usuarios</h1>
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
                <span class="input-group-text" id="inputGroup-sizing-sm">Correo</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
            <select class="form-select form-select-sm" aria-label="Small select example">
                <option selected disabled>Perfil</option>
                <option value="todos">Todos</option>
                <option value="admin">Admin</option>
                <option value="user">Usuario</option>
            </select>
            <button type="button" class="btn btn-outline-light btn-sm">Filtrar</button>
        </div>
    </div>
    <div class="user-buttons">
        <a class="btn btn-success" href="/lab_prog_2025_Molina_Fabian/public/user/create" role="button">Alta
            Usuario</a>
        <a class="btn btn-secondary" href="javascript:void(0)" role="button">Exportar listado</a>
    </div>
</div>
<div class="table-container">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Cuenta</th>
                <th scope="col">Perfil</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tbodyUser"></tbody>
    </table>
</div>