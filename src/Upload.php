<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 16:38
 */

namespace VS\Gallery;

/**
 * Class Upload
 * @package VS\Gallery
 */
class Upload
{
    /**
     * @var array $_config
     */
    protected $_config;
    /**
     * @var string $_ext
     * */
    protected $_ext;
    /**
     * @var string $_name
     * */
    protected $_name;
    /**
     * @var string $_type
     * */
    protected $_type;
    /**
     * @var array $_multiNames
     * */
    protected $_multiNames = array();
    /**
     * @var string $_tmpName
     * */
    protected $_tmpName;
    /**
     * @var array|bool $_error
     * */
    protected $_error = false;
    /**
     * @var int $_size
     * */
    protected $_size;

    /**
     * Upload constructor.
     */
    public function __construct()
    {
        $this->_config = App::getInstance()->getConfig('upload');
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->_ext;
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->_tmpName;
    }

    /**
     * @param $key
     */
    public function one($key)
    {
        $file = self::_isFile($key);

        $this->_name = $file['name'];
        $this->_type = $file['type'];
        $this->_tmpName = $file['tmp_name'];
        $this->_size = $file['size'];
        $this->_finish();
    }

    /**
     * @return string
     */
    public function getUploadedName()
    {
        return $this->_name;
    }

    /**
     * @return array
     */
    public function getUploadedNames()
    {
        return $this->_multiNames;
    }

    /**
     * @return array|bool
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * @param $key
     * @return bool
     */
    protected function _isFile($key)
    {
        if(empty($_FILES[$key]) || $_FILES[$key]['size'] <= 0){
            return false;
        }

        return $_FILES[$key];
    }

    /**
     * @param int $bytes
     * @return string
     */
    protected function _fileSize($bytes)
    {
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), [0,0,2,2,3][$i]).['B','kB','MB','GB','TB'][$i];
    }

    /**
     * finish method
     * @return Upload
     * */
    protected function _finish()
    {
        if ($this->_validate() && $this->_error === false) {
            $this->_name = uniqid('vs-gallery-') . '.' . $this->_ext;

            if (!is_dir($this->_config['uploadPath'])) {
                $this->_error['invalidUploadPath'] = $this->_config['uploadPath'];
                return null;
            }

            if (move_uploaded_file($this->_tmpName, $this->_config['uploadPath'] . $this->_name)) {
                $this->_multiNames[] = $this->_name;
            } else {
                $this->_error['canNotUploadFile'] = '';
            }
        }
    }

    /**
     * @return bool
     */
    private function _validate()
    {
        $sizeDetails = getimagesize($this->_tmpName);

        if ($sizeDetails[0] > $this->_config["maxWidth"]) {
            $this->_error['invalidImageWidth'] = $this->_config["maxWidth"];
        }

        if ($sizeDetails[1] > $this->_config["maxHeight"]) {
            $this->_error['invalidImageHeight'] = $this->_config["maxHeight"];
        }

        if ($this->_size > $this->_config['maxSize'] * pow(1024,2)) {
            $this->_error['invalidImageSize'] = $this->_config['maxSize']."MB";
        }

        $this->_ext = pathinfo($this->_name, PATHINFO_EXTENSION);
        if (!in_array(strtolower($this->_ext), $this->_config['allowedTypes'])) {
            $this->_error['invalidImageType'] = implode(",", $this->_config['allowedTypes']);
        }
        return true;
    }
}