<?php

namespace app\core\models\dao;

use app\core\models\dao\base\BaseDao;
use app\core\models\dao\base\InterfaceDao;

final class UsuarioDao extends BaseDao implements InterfaceDao{

    public function __construct(\PDO $connection){
        parent::__construct($connection, "usuarios");
    }

    public function login($cuenta): array{
        $sql = "SELECT id, apellido, nombres, cuenta, perfil, clave, correo, estado, resetPass";
        $sql .= " FROM usuarios";
        $sql .= " WHERE (cuenta = :cuenta OR correo = :cuenta)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["cuenta" => $cuenta]);
        if($stmt->rowCount() != 1){
            throw new \Exception("El nombre de usuario o la contraseña no coinciden");
        }
        return $stmt->fetch(\PDO::FETCH_ASSOC);
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