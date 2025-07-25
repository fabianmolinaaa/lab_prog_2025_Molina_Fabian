<?php

namespace app\core\controllers;

use app\core\controllers\base\BaseController;
use app\libs\http\Request;
use app\libs\http\Response;

final class HomeController extends BaseController{

    public function index(Request $request, Response $response): void{
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js"); 
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }
}