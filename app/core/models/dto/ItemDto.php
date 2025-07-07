<?php

namespace app\core\models\dto;

use app\core\models\dto\base\InterfaceDto;

final class ItemDto implements InterfaceDto{

    private $id, $nombre, $codigo, $descripcion, $categoriaId, $precio, $stock;

    public function __construct($data = []) {
        $this->setId($data["id"] ?? 0);
        $this->setNombre($data["nombre"] ?? "");
        $this->setCodigo($data["codigo"] ?? "");
        $this->setDescripcion($data["descripcion"] ?? "");
        $this->setCategoriaId($data["categoria_id"] ?? 0);
        $this->setPrecio($data["precio"] ?? 0);
        $this->setStock($data["stock"] ?? 0);
    }

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id > 0 ? $id : 0;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre(string $nombre): void{
        $this->nombre = (strlen(trim($nombre)) <= 100) ? trim($nombre) : "";
    }

    
    public function getCodigo(): string{
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void{
        $this->codigo = (strlen(trim($codigo)) <= 25) ? trim($codigo) : "";
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = (strlen(trim($descripcion)) <= 255) ? trim($descripcion) : "";
    }

    public function getCategoriaId(): int{
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void{
        $this->categoriaId = $categoriaId > 0 && $categoriaId <= 10 ? $categoriaId : 0; //Si categoriaId es mayor a 0 y menor o igual a 10, se asigna, caso contrario se asigna 0
    }

    public function getPrecio(): float{
        return $this->precio;
    }

    public function setPrecio(float $precio): void{
        $this->precio = $precio >= 0 && $precio <= 9999999.99 ? $precio : 0; //Si precio es mayor a 0, se asigna, caso contrario se asigna 0
    }

    public function getStock(): int{
        return $this->stock;
    }

    public function setStock(int $stock): void{
        $this->stock = $stock >= 0 && $stock <= 999999 ? $stock : 0; //Si stock es mayor a 0, se asigna, caso contrario se asigna 0
    }


    public function toArray(): array{
        return [
            "id"            => $this->getId(),
            "nombre"        => $this->getNombre(),
            "codigo"        => $this->getCodigo(),
            "descripcion"   => $this->getDescripcion(),
            "categoria_id"  => $this->getCategoriaId(),
            "precio"        => $this->getPrecio(),
            "stock"         => $this->getStock()
        ];
    }

}