<?php

namespace app\core\controllers;

use app\core\controllers\base\BaseController;
use app\core\controllers\base\InterfaceController;
use app\core\models\dto\ItemDto;
use app\core\services\ItemService;
use app\libs\http\Request;
use app\libs\http\Response;

final class ItemController extends BaseController implements InterfaceController{

    public function index(Request $request, Response $response): void{
        array_push($this->scripts, "app/js/item/index.js");
        array_push($this->styles, "app/css/item/index.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function load(Request $request, Response $response): void{
        $service = new CategoriaService();
        $dto = $service->load((int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();
    }

    public function create(Request $request, Response $response): void{

    }

    public function save(Request $request, Response $response): void{
        $dto = new CategoriaDto($request->getDataFromInput()); 
        $service = new CategoriaService();
        $service->save($dto);
        
        $response->setMessage("<p>Se agregó una nueva categoría al sistema.</p>");
        $response->send();
    }

    public function edit(Request $request, Response $response): void{

    }

    public function update(Request $request, Response $response): void{

    }

    public function delete(Request $request, Response $response): void{
        $dto = new CategoriaDto($request->getDataFromInput());
        $service = new CategoriaService();
        $service->delete($dto);
        
        $response->setMessage("<p>Se eliminó la categoría del sistema.</p>");
        $response->send();
    }

    public function list(Request $request, Response $response): void{
        $service = new CategoriaService();
        $dto = $service->list($request->getDataFromInput());
        $response->setResult($dto);
        $response->send();
    }

}