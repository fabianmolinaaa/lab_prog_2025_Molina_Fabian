<!-- BreadCrumb -->
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>

<div class="alta-container">
    <div id="title-container">
        <h1>Alta de usuario</h1>
    </div>
    <div class="form-container">
        <div id="form-title-container">
            <p>Por favor, complete los siguientes campos:</p>
        </div>
        <form id="formUser" action="" autocomplete="off">
            <input id="nombre" type="text" placeholder="Nombre" required>
            <input id="apellido" type="text" placeholder="Apellido" required>
            <input id="cuenta" type="text" placeholder="Cuenta" required>
            <select name="perfil" id="perfil" required>
                <option value="" disabled selected>Perfil</option>
                <option value="admin">Operador</option>
                <option value="user">Administrador</option>
            </select>
            <input id="telefono" type="number" placeholder="Telefono" required>
            <input id="correo" type="email" placeholder="Correo" required>
            <input id="password" type="password" placeholder="Contraseña" required>
            <input id="confirmPassword" type="password" placeholder="Confirmar contraseña" required>
            <div class="botones-container">
                <button id="btnCancelarUser" class="btn btn-danger" type="button">Cancelar</button>
                <button id="btnGuardarUser" class="btn btn-success" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>