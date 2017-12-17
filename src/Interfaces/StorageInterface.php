<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:13
 */

namespace VS\Gallery\Interfaces;

/**
 * Interface StorageInterface
 * @package VS\Gallery\Interfaces
 */
interface StorageInterface
{
    public function name($table);

    public function create($data);

    public function read($id = null);

    public function update($id, $data);

    public function destroy($id);
}