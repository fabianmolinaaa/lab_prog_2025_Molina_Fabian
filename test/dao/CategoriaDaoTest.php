<?php

require_once '../../app/core/models/dao/base/InterfaceDao.php';
require_once '../../app/core/models/dao/base/BaseDao.php';
require_once '../../app/core/models/dao/CategoriaDao.php';
require_once "../../app/config/DBConfig.php";
require_once "../../app/libs/database/Connection.php";
require_once '../../app/core/models/dto/base/InterfaceDto.php';
require_once '../../app/core/models/dto/CategoriaDto.php';

use app\libs\database\Connection;
use app\core\models\dto\CategoriaDto;
use app\core\models\dao\CategoriaDao;

try{
    /*
     Prueba de inserción de categoría
     
    $data = ["id" => 0, "nombre" => "pantalones"];
    $dto = new CategoriaDto($data);

    $dao = new CategoriaDao(Connection::get());
    $dao->save($dto->toArray());
    */

    /*
     Prueba de actualización de categoría
    

    try {
        // 1. Primero creamos una nueva categoría
        $data = ["nombre" => "camperas temporal"];
        $dto = new CategoriaDto($data);
    
        $dao = new CategoriaDao(Connection::get());
        $dao->save($dto->toArray());
        
        // Obtenemos el ID de la categoría recién creada
        $lastId = $dao->getLastInsertId();
        
        if ($lastId === 0) {
            throw new \Exception("No se pudo obtener el ID de la categoría creada");
        }
        
        // 2. Ahora actualizamos la categoría
        $dataActualizada = ["id" => $lastId, "nombre" => "camperas actualizadas"];
        $dto = new CategoriaDto($dataActualizada);
        $dao->update($dto->toArray());
        
        echo "Categoría actualizada exitosamente. ID: $lastId\n";
        
    } catch(\PDOException $ex) {
        echo "Error database => " . $ex->getMessage() . "\n";
    } catch(\Exception $ex) {
        echo "Error => " . $ex->getMessage() . "\n";
    }
    */

    /*
    Prueba de eliminación de categoría
    try {
        $dao = new CategoriaDao(Connection::get());
        $dao->delete(10);
        echo "Categoría eliminada exitosamente.\n";
    } catch(\PDOException $ex) {
        echo "Error database => " . $ex->getMessage() . "\n";
    } catch(\Exception $ex) {
        echo "Error => " . $ex->getMessage() . "\n";
    }*/

    
    // Prueba de actualizacion de categoria
    try {
        $dao = new CategoriaDao(Connection::get());
        $dto = $dao->load(1); // Esto debería devolver un CategoriaDTO
        $dto->setNombre("camperas actualizadas"); // Usar método setter
        $dao->update($dto);
    echo "Categoría actualizada exitosamente.\n";
    } catch(\PDOException $ex) {
        echo "Error database => " . $ex->getMessage() . "\n";
    } catch(\Exception $ex) {
        echo "Error => " . $ex->getMessage() . "\n";
    }
    
}
catch(\PDOException $ex){
    echo "Error database => " . $ex->getMessage();
}