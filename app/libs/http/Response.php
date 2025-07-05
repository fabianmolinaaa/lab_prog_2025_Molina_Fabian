<?php

namespace app\libs\http;

final class Response{
    private $controller, $action, $error, $message, $result;

    public function __construct(){
        $this->setController("");
        $this->setAction("");
        $this->setError("");
        $this->setMessage("");
        $this->setResult([]);
    }

    public function getController(): ?string{
        return $this->controller;
    }

    public function setController($controller): void{
        $this->controller = $controller;
    }

    public function getAction(): ?string{
        return $this->action;
    }

    public function setAction($action): void{
        $this->action = $action;
    }

    public function getError(): ?string{
        return $this->error;
    }

    public function setError($error): void{
        $this->error = $error;
    }

    public function getMessage(): ?string{
        return $this->message;
    }

    public function setMessage($message): void{
        $this->message = $message;
    }

    public function getResult(): ?array{
        return $this->result;
    }

    public function setResult($result): void{
        $this->result = $result;
    }

    public function send(): void{
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode([
            "controller"    => $this->controller,
            "action"        => $this->action,
            "error"         => $this->error,
            "message"       => $this->message,
            "result"        => $this->result
        ]);
    }
}