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

    public function create(Request $request, Response $response): void{
        array_push($this->scripts, "app/js/item/create.js");
        array_push($this->styles, "app/css/item/create.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function edit(Request $request, Response $response): void{
        array_push($this->scripts, "app/js/item/edit.js");
        array_push($this->styles, "app/css/item/edit.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function load(Request $request, Response $response): void{
        $service = new ItemService();
        $dto = $service->load((int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();
    }

    public function save(Request $request, Response $response): void{
        try {
            $dto = new ItemDto($request->getDataFromInput()); 
            $service = new ItemService();
            $service->save($dto);
            $response->setMessage("<p>Se guardó un nuevo item al sistema.</p>");
            $response->send();
        } catch (\Exception $e) {
            $response->setMessage("<p>Hubo un error al guardar el item.</p>");
            $response->send();
        }
    }

    public function update(Request $request, Response $response): void{

    }

    public function delete(Request $request, Response $response): void{
        $dto = new ItemDto($request->getDataFromInput());
        $service = new ItemService();
        $service->delete($dto);
        
        $response->setMessage("<p>Se eliminó el item del sistema.</p>");
        $response->send();
    }

    public function list(Request $request, Response $response): void{
        $service = new ItemService();
        $data = $service->list();
        $response->setResult($data);
        $response->send();
    }

}