<div class="logo-container">
    <img src="<?= APP_URL ?>app/assets/images/letterLogo-removebg-preview.png" alt="Logo">
</div>
<nav>
    <ul>
        <li><a href="<?= APP_URL ?>home">Inicio</a></li>
        <li><a href="<?= APP_URL ?>item">Eventos</a></li>
        <li><a href="<?= APP_URL ?>sale">Tickets</a></li>
        <li><a href="<?= APP_URL ?>user">Usuarios</a></li>
        <li>
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Mi Cuenta
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0)">Mis datos</a></li>
                    <li><a class="dropdown-item" href="<?= APP_URL ?>authentication/logout">Cerrar sesión</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>