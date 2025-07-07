<?php

namespace app\core\models\dao;

use app\core\models\dao\base\BaseDao;
use app\core\models\dao\base\InterfaceDao;

final class UsuarioDao extends BaseDao implements InterfaceDao{

    public function __construct(\PDO $connection){
        parent::__construct($connection, "usuarios");
    }
    

    public function load(int $id): array{
        return[];
    }

    public function save(array $data): void{
        
    }

    public function update(array $data): void{

    }

    public function delete(int $id): void{

    }

    public function list(array $filters): array{
        return [];
    }

    public function suggestive(array $filters): array{
        return [];
    }

    public function foundRows(): int{
        return 0;
    }

    public function getLastInsertId(): int{
        return 0;
    }

}