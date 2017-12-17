<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:35
 */

namespace App\Models;

use VS\Gallery\BaseModel;

/**
 * Class Gallery
 * @package App\Models
 */
class Gallery extends BaseModel
{
    /**
     * @var string
     */
    protected $_table = 'galleries';

    /**
     * @param int $userId
     * @return array
     */
    public function allForUser($userId)
    {
        $galleries = $this->_storageInterface->name($this->_table)->read();
        $sortedForUser = [];
        foreach ($galleries as $gallery) {
            if ($gallery->user_id === $userId) {
                $sortedForUser[] = $gallery;
            }
        }

        return $sortedForUser;
    }
}