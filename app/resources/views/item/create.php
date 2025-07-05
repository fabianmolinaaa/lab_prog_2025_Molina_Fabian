<header id="menu-principal">
    <div class="logo-container">
        <img src="/lab_prog_2025_Molina_Fabian/public/app/assets/images/letterLogo-removebg-preview.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="/lab_prog_2025_Molina_Fabian/public/home">Inicio</a></li>
            <li><a href="/lab_prog_2025_Molina_Fabian/public/item">Eventos</a></li>
            <li><a href="/lab_prog_2025_Molina_Fabian/public/sale">Tickets</a></li>
            <li><a href="/lab_prog_2025_Molina_Fabian/public/user">Usuarios</a></li>
            <li>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Mi Cuenta
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:void(0)">Mis datos</a></li>
                        <li><a class="dropdown-item" href="/lab_prog_2025_Molina_Fabian/public/authentication">Cerrar
                                sesión</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>
<main id="seccion-principal">
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
            <form id="formItem" action="" autocomplete="off">
                <input id="name" type="text" placeholder="Nombre" required>
                <input id="price" type="number" placeholder="Precio" min="0" max="100000000" required>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Categoria</option>
                    <option value="presencial">Presencial</option>
                    <option value="online">Online</option>
                </select>
                <input id="stock" type="number" placeholder="Cantidad de Entradas" min="0" max="5000" required>
                <textarea id="description" name="description" placeholder="Descripción" required></textarea>
                <div class="botones-container">
                    <button id="btnCancelarItem" class="btn btn-danger" type="button">Cancelar</button>
                    <button id="btnGuardarItem" class="btn btn-success" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</main>