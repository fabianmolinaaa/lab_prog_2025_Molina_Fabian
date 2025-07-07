<?php

namespace app\core\controllers;

use app\core\controllers\base\BaseController;
use app\core\services\AuthenticationService;
use app\libs\http\Request;
use app\libs\http\Response;

final class AuthenticationController extends BaseController{

    public function index(Request $request, Response $response): void{
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
        require_once APP_FILE_LOGIN;
    }

    public function login(Request $request, Response $response): void{
        try {
            $data = $request->getDataFromInput();
            $service = new AuthenticationService();
            $service->login($data);
            $response->setMessage("OK");
            $response->send();
        } catch (\Exception $e) {
            $response->setMessage("Error sistema => " . $e->getMessage());
            $response->send();
        }
    }

    public function logout(Request $request, Response $response): void{
        $service = new AuthenticationService();
        $service->logout();
        $this->setCurrentView($request);
        header("refresh:5;url=" . APP_URL . "authentication/index");
        require_once APP_FILE_LOGOUT;
    }

}