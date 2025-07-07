<?php

namespace app\core\services;

use app\libs\database\Connection;

final class AuthenticationService{
    public function login(array $object): void{
    
        $conn = Connection::get();

        $account = $object["account"];
        $password = $object["password"];

        if ($account === "" || $password === "") {
            throw new \Exception("El nombre de usuario o la contraseña no coinciden");
        }
        
        $sql = "SELECT id, apellido, nombres, cuenta, perfil, clave, correo, estado, resetPass";
        $sql .= " FROM usuarios";
        $sql .= " WHERE (cuenta = :account OR correo = :account)";

        $stmt = $conn->prepare($sql);

        $stmt->execute(["account" => $account]);

        //* Validaciones de la cuenta
        if($stmt->rowCount() != 1){
            throw new \Exception("El nombre de usuario o la contraseña no coinciden");
        }

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC); //Se obtiene el usuario

        if(!password_verify($password, $usuario["clave"])){
            throw new \Exception("El usuario o la clave es incorrecta.");
        }
        if($usuario["estado"] !== 1){
            throw new \Exception("Su cuenta esta inactiva.");
        }
        if($usuario["resetPass"] !== 0){
            throw new \Exception("Su clave ha caducado.");
        }

        //Se registran las variables de sessión
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuarioId"] = (int)$usuario["id"];
        $_SESSION["usuario"] = $usuario["nombres"];
        $_SESSION["perfil"] = $usuario["perfil"];
    }
    
    public function logout():void{
        session_unset();
        if (ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]);
            }
        session_destroy();
    }
}