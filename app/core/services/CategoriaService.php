<?php

namespace app\core\services;

use app\core\models\dao\CategoriaDao;
use app\core\models\dto\base\InterfaceDto;
use app\core\models\dto\CategoriaDto;
use app\core\services\base\InterfaceService;
use app\libs\database\Connection;

final class CategoriaService implements InterfaceService{
    
    public function load(int $id): InterfaceDto{
        $dao = new CategoriaDao(Connection::get());
        return new CategoriaDto($dao->load($id));
    }

    public function save(InterfaceDto $dto): void{
        $this->validate($dto);
        $data = $dto->toArray();
        unset($data["id"]);
        $dao = new CategoriaDao(Connection::get());
        $dao->save($data);
    }

    public function update(InterfaceDto $dto): void{

    }

    public function delete(InterfaceDto $dto): void{
        $dao = new CategoriaDao(Connection::get());
        $dao->delete($dto->getId());
    }

    public function list(array $filters): array{
        $dao = new CategoriaDao(Connection::get());
        return $dao->list($filters);
    }

    private function validate(CategoriaDto $dto): void{
        if($dto->getNombre() == ""){
            throw new \Exception("<p>El <strong>nombre</strong> de la categoría es obligatorio.</p>");
        }
    }

}