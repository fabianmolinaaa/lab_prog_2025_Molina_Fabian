<?php

/*
* Establece métodos comunes que todos los DAOs deben implementar (CRUD básico)
*/

 namespace app\core\models\dao\base;

 use app\core\models\dto\base\InterfaceDto;

 /**
 * Descripción de la clase InterfaceDao
 *
 * @author Ing. Rasjido jose
 */
 interface InterfaceDao{

    public function load(int $id): InterfaceDto;

    /**
     * Guarda los datos del objeto pasado como parámetro, como un nuevo registro en la base de datos.
     * @param array $data Arreglo con datos a guardarse como un nuevo registro en la base de datos.
     */
    public function save(InterfaceDto $object): void;

    /**
     * Actualiza los datos de un registro existente.
     * @param array $data Arreglo con datos a actualizar en su correspondiente registro en base de  datos.
     */
    public function update(interfaceDto $object): void;

    /**
     * Elimina de la base de datos un registro.
     * @param int $id Identificador del registro a eliminar en la base de datos.
     */
    public function delete(int $id): void;

    /**
     * Lista los registros de una tabla.
     * @param array $filters Parámetros a tener en cuenta en la sentencia SQL.
     * @return array Devuelve un arreglo con los registros encontrados.
     */
    public function list(array $filters): array;

    /**
     * Lista los registros de una tabla, en base a una búsqueda sugestiva.
     * @param array $filters Filtro, clave o dato ingresado por el usuario en el sugestivo.
     * @return array Devuelve un arreglo con los registros encontrados.
     */
    public function suggestive(array $filters): array;

    /**
     * Devuelve la cantidad total de registros afectados por una consulta SELECT SQL_CALC_FOUND_ROWS.
     * Este método se debería invocar despues de llamar a un método list(), desde cualquier DAO.
     * @return int Cantidad de registros afectados, sin la cláusula "limit".
     */
    public function foundRows(): int;

    /**
     * Retorna el último id (indice primario autoincremental) generador por la conexión del dao actual.
     */
    public function getLastInsertId(): int;

 }