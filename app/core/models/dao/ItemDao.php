<?php

namespace app\core\models\dao;

use app\core\models\dao\base\BaseDao;
use app\core\models\dao\base\InterfaceDao;
use app\core\models\dto\base\InterfaceDto;
use app\core\models\dto\ItemDto;

final class ItemDao extends BaseDao implements InterfaceDao{

    public function __construct(\PDO $connection)
    {
        parent::__construct($connection, "productos");
    }

    public function load(int $id): InterfaceDto {
        $sql = "SELECT
                    productos.id,
                    productos.nombre,
                    productos.codigo,
                    productos.descripcion,
                    productos.categoriaId,
                    categorias.nombre AS nombreCategoria,
                    productos.precio,
                    productos.stock
                FROM
                    productos
                INNER JOIN
                    categorias
                ON
                    productos.categoriaId = categorias.id
                WHERE
                    productos.id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([":id" => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$data) {
            throw new \Exception("No se encontraron coincidencias para el identificador del Item ({$id})");
        }
        return new ItemDto($data);
    }

    public function save(InterfaceDto $object): void
    {
        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT, :nombre, :codigo, :descripcion, :categoriaId, :precio, :stock)";
        $stmt = $this->connection->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute([
            ':nombre' => $data['nombre'] ?? null,
            ':codigo' => $data['codigo'] ?? null,
            ':descripcion' => $data['descripcion'] ?? null,
            ':categoriaId' => $data['categoriaId'] ?? null,
            ':precio' => $data['precio'] ?? null,
            ':stock' => $data['stock'] ?? null,
        ]);
    }

    public function update(InterfaceDto $object): void {
        if ($object->getId() <= 0) {
            throw new \InvalidArgumentException("El identificador del Item es obligatorio.");
        }
        $sql = "UPDATE {$this->table} SET nombre = :nombre, codigo = :codigo, descripcion = :descripcion, categoriaId = :categoriaId, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $data = $object->toArray();
        $stmt->execute([
            ':nombre' => $data['nombre'],
            ':codigo' => $data['codigo'],
            ':descripcion' => $data['descripcion'],
            ':categoriaId' => $data['categoriaId'],
            ':precio' => $data['precio'],
            ':stock' => $data['stock'],
            ':id' => $data['id'],
        ]);
    }

    public function delete(int $id): void {
        if ($id <= 0) {
            throw new \InvalidArgumentException("El identificador del Item es obligatorio.");
        }
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() === 0) {
            throw new \InvalidArgumentException("No se encontraron coincidencias para el identificador del Item ({$id})");
        }
    }

    public function list(array $filters = []): array {
        $sql = "SELECT
                    {$this->table}.id,
                    {$this->table}.nombre,
                    {$this->table}.codigo,
                    {$this->table}.descripcion,
                    {$this->table}.categoriaId,
                    categorias.nombre AS nombreCategoria,
                    {$this->table}.precio,
                    {$this->table}.stock
                FROM
                    {$this->table}
                INNER JOIN
                    categorias
                ON
                    {$this->table}.categoriaId = categorias.id
                ORDER BY
                    {$this->table}.id ASC";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function suggestive(array $filters): array
    {
        return [];
    }

    public function foundRows(): int
    {
        return 0;
    }

    public function getLastInsertId(): int
    {
        return 0;
    }

}