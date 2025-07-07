<?php

require_once '../../app/config/AppConfig.php';
require_once '../../app/config/DBConfig.php';
require_once '../../app/vendor/autoload.php';


use app\core\models\dto\ItemDto;
use app\core\services\ItemService;

try{ 
    $itemService = new ItemService();
    $items = $itemService->list();
    foreach($items as $item){
        echo $item['id'] . " - " . $item['nombre'] . "<br>";
    }
}
catch(\PDOException $ex){
    echo "Error database => " . $ex->getMessage();
}
catch(\Exception $ex){
    echo "Error sistema => " . $ex->getMessage();
}