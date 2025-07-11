<?php

namespace app\core\services;

use app\core\models\dao\ItemDao;
use app\core\models\dto\base\InterfaceDto;
use app\core\models\dto\ItemDto;
use app\core\services\base\InterfaceService;
use app\libs\database\Connection;

final class ItemService implements InterfaceService{
    
    public function load(int $id): InterfaceDto{
        $dao = new ItemDao(Connection::get());
        return $dao->load($id);
    }

    public function save(InterfaceDto $dto): void{
        $this->validate($dto);
        $dao = new ItemDao(Connection::get());
        $dao->save($dto);
    }

    public function update(InterfaceDto $dto): void{

    }

    public function delete(InterfaceDto $dto): void{
        $dao = new ItemDao(Connection::get());
        $dao->delete($dto->getId());
    }

    public function list(): array{
        $dao = new ItemDao(Connection::get());
        return $dao->list();
    }

    private function validate(ItemDto $dto): void{
        if($dto->getNombre() == ""){
            throw new \Exception("<p>El <strong>nombre</strong> del item es obligatorio.</p>");
        }
        if($dto->getCategoriaId() <= 0) {
            throw new \Exception("Debe seleccionar una categoría válida");
        }
    }

}