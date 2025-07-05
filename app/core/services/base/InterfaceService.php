<?php
// Metodos que debería tener en todos los servicios

namespace app\core\services\base;

use app\core\models\dto\base\InterfaceDto;

interface InterfaceService {
    public function load(int $id): InterfaceDto;
    public function list(array $filters): array;
    public function save(InterfaceDto $data): void;
    public function update(InterfaceDto $dto): void;
    public function delete(InterfaceDto $dto): void;
}