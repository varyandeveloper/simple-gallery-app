<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:11
 */

namespace VS\Gallery;

use VS\Gallery\Interfaces\StorageInterface;

/**
 * Class BaseModel
 * @package VS\Gallery
 */
abstract class BaseModel
{
    /**
     * @var string $_table
     */
    protected $_table;
    /**
     * @var string $_storageObjectName
     */
    protected $_storageObjectName = 'VS\Gallery\Storage\JsonStorage';

    /**
     * @var StorageInterface $_storageInterface
     */
    protected $_storageInterface;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->_storageInterface = new $this->_storageObjectName();
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_reverse($this->_storageInterface->name($this->_table)->read());
    }

    /**
     * @return mixed
     */
    public function getMaxId()
    {
        $data = $this->all();
        if (!$data) {
            return 0;
        }
        // because revered
        return $data[0]->id;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->_storageInterface->name($this->_table)->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        return $this->_storageInterface->name($this->_table)->update($id, $data);
    }

    /**
     * @param $id
     * @return \stdClass
     */
    public function find($id)
    {
        return $this->_storageInterface->name($this->_table)->read($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function remove($id)
    {
        return $this->_storageInterface->name($this->_table)->destroy($id);
    }
}