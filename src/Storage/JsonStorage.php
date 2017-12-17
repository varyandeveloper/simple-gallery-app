<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:15
 */

namespace VS\Gallery\Storage;

use VS\Gallery\Interfaces\StorageInterface;

/**
 * Class JsonStorage
 * @package VS\Gallery\Storage
 */
class JsonStorage implements StorageInterface
{
    /**
     * @var string $_fileName
     */
    protected $_fileName;

    /**
     * @param string $fileName
     * @return $this
     * @throws \Exception
     */
    public function name($fileName)
    {
        $this->_fileName = APP . 'storage/' . $fileName . '.json';
        if (!is_file($this->_fileName)) {
            throw new \Exception('Storage ' . $this->_fileName . ' not found.');
        }
        return $this;
    }

    /**
     * @param $data
     * @param bool $replace
     * @return bool
     */
    public function create($data, $replace = false)
    {
        if (!$replace) {
            $records = $this->read();
            $records[] = $data;
            $data = $records;
        }

        if (file_put_contents($this->_fileName, json_encode($data))) {
            return true;
        }

        return false;
    }

    /**
     * @param null $id
     * @return mixed|null
     */
    public function read($id = null)
    {
        $data = json_decode(file_get_contents($this->_fileName));
        if (!is_array($data)) {
            $data = [];
        }
        if (null !== $id) {
            foreach ($data as $datum) {
                if ($datum->id == $id) {
                    return $datum;
                }
            }
            return null;
        }

        return $data;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $updated = false;
        $records = $this->read();
        foreach ($records as $index => &$datum) {
            if ($datum->id == $id) {
                foreach ($data as $field => $value){
                    $datum->{$field} = $value;
                }
                $updated = true;
                break;
            }
        }
        $this->create($records, true);
        return $updated;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $founded = false;
        $data = $this->read();
        foreach ($data as $index => $datum) {
            if ($id == $datum->id) {
                unset($data[$index]);
                $founded = true;
                break;
            }
        }

        $this->create(array_values($data), true);
        return $founded;
    }

}