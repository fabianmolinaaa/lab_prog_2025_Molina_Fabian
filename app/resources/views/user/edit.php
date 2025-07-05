<!-- BreadCrumb -->
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>

<div class="alta-container">
    <div id="title-container">
        <h1>Editar usuario</h1>
        <p>Estado de la cuenta: </p>
        <div>
            <button type="button" class="btn btn-danger">Eliminar registro</button>
            <button id="btnExportarPDF" type="button" class="btn btn-light">Exportar a PDF</button>
        </div>
    </div>
    <div class="form-container">
        <div id="form-title-container">
            <p>Edite los campos que desee modificar</p>
        </div>
        <form id="formUser" action="" autocomplete="off">
            <input id="name" type="text" placeholder="Nombre" disabled>
            <input id="lastName" type="text" placeholder="Apellido" disabled>
            <input id="cuenta" type="text" placeholder="Cuenta" disabled>
            <select id="perfil" name="perfil" disabled>
                <option value="" disabled selected>Perfil</option>
                <option value="admin">Operador</option>
                <option value="user">Administrador</option>
            </select>
            <input id="email" type="email" placeholder="Correo" disabled>
            <input id="password" type="password" placeholder="Contraseña" disabled>
            <input id="confirmPassword" type="password" placeholder="Confirmar contraseña" disabled>
            <div class="botones-container">
                <button id="editButton" type="button" class="btn btn-primary">Editar</button>
                <button id="saveButton" type="button" class="btn btn-success">Guardar</button>
                <button id="cancelButton" type="button" class="btn btn-danger">Cancelar</button>
                <a href="/lab_prog_2025_Molina_Fabian/public/user" class="btn btn-secondary">Listado</a>
            </div>
        </form>
    </div>
</div>