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
        return new ItemDto($dao->load($id));
    }

    public function save(InterfaceDto $dto): void{
        $this->validate($dto);
        $data = $dto->toArray();
        unset($data["id"]);
        $dao = new ItemDao(Connection::get());
        $dao->save($data);
    }

    public function update(InterfaceDto $dto): void{

    }

    public function delete(InterfaceDto $dto): void{
        $dao = new ItemDao(Connection::get());
        $dao->delete($dto->getId());
    }

    public function list(array $filters): array{
        $dao = new ItemDao(Connection::get());
        return $dao->list($filters);
    }

    private function validate(ItemDto $dto): void{
        if($dto->getNombre() == ""){
            throw new \Exception("<p>El <strong>nombre</strong> del item es obligatorio.</p>");
        }
    }

}