<?php

//* URL base de la aplicación
const APP_URL = "http://localhost/lab_prog_2025_Molina_Fabian/public/";

//* Configuración de rutas del sistema de archivos
define('APP_URI', $_SERVER['DOCUMENT_ROOT'] . '/lab_prog_2025_Molina_Fabian/app/');

//* Directorios para templates y vistas
define('APP_DIR_TEMPLATE', APP_URI . 'resources/template/');
define('APP_DIR_VIEWS', APP_URI . 'resources/views/');

//* Archivos importantes
define('APP_FILE_TEMPLATE', APP_DIR_TEMPLATE . 'template.php');
define('APP_FILE_LOGIN', APP_DIR_VIEWS . 'authentication/index.php');
define('APP_FILE_LOGOUT', APP_DIR_VIEWS . 'authentication/logout.php');

//*#########################################
//* CONTROLADOR Y ACCION POR DEFECTO
//*#########################################

const APP_DEFAULT_CONTROLLER = "authentication";
const APP_DEFAULT_ACTION = "index";

const APP_AUTHENTICATION_CONTROLLER = "authentication";
const APP_LOGIN_ACTION = "login";

//*#########################################
//* MANEJO DE SESIONES
//*#########################################

const APP_TOKEN = '$2y$10$I/YVeyxK2NQuJVPq.JqVCOELQXl1b.lhPMjr09RgbhKHGgW0Vwxou';