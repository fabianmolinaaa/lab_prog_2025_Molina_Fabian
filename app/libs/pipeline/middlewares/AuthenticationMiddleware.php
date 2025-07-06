<?php

namespace app\libs\pipeline\middlewares;

use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\base\BaseMiddleware;
use app\libs\pipeline\middlewares\base\InterfaceMiddleware;

final class AuthenticationMiddleware extends BaseMiddleware implements InterfaceMiddleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handler(Request $request, Response $response): void
    {

        session_start();

        // Excepciones para las rutas de login
        $isLoginPage = $request->getController() === APP_AUTHENTICATION_CONTROLLER &&
            ($request->getAction() === APP_DEFAULT_ACTION || $request->getAction() === APP_LOGIN_ACTION);

        if ($isLoginPage && isset($_SESSION['token']) && $_SESSION['token'] === APP_TOKEN) {
            // Si ya está autenticado y va a login, redirigir a home
            header("Location: " . APP_URL . "home/index");
            exit;
        }

        if (!$isLoginPage && (!isset($_SESSION['token']) || $_SESSION['token'] !== APP_TOKEN)) {
            // Si no está autenticado y no es una página de login, redirigir a login
            header("Location: " . APP_URL . "authentication/index");
            exit;
        }

        $this->handlerNext($request, $response);
    }
}


