<?php

namespace app\core\models\dto;

use app\core\models\dto\base\InterfaceDto;
final class LoginDto implements InterfaceDto{
    
    private $username, $password;

    public function __construct(array $data = []) {
        $this->setUsername($data["userName"] ?? "");
        $this->setPassword($data["password"] ?? "");
    }
    // Getters y Setters
    public function setUsername(string $username){
        $this->username = $username;
    }
    public function getUsername(): string{
        return $this->username;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function toArray(): array{
        return [
            "userName" => $this->getUsername(),
            "password" => $this->getPassword()
        ];
    }
    
    
}