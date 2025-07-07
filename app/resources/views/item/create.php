    <!-- BreadCrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/lab_prog_2025_Molina_Fabian/public/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Eventos</li>
        </ol>
    </nav>
    <div class="alta-container">
        <div id="title-container">
            <h1>Alta de Evento</h1>
        </div>
        <div class="form-container">
            <div id="form-title-container">
                <p>Por favor, complete los siguientes campos:</p>
            </div>
            <form id="formItem" action="" autocomplete="off">
                <input id="nombre" type="text" placeholder="Nombre" required>
                <input id="precio" type="number" placeholder="Precio" min="0" max="9999999" required>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected>Categoria</option>
                    <option value="1">Presencial</option>
                    <option value="2">Online</option>
                </select>
                <input id="stock" type="number" placeholder="Cantidad de Entradas" min="0" max="9999999" required>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
                <div class="botones-container">
                    <button id="btnCancelarItem" class="btn btn-danger" type="button">Cancelar</button>
                    <button id="btnGuardarItem" class="btn btn-success" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>