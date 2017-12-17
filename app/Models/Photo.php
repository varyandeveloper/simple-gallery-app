<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:57
 */

namespace App\Models;

use VS\Gallery\BaseModel;

/**
 * Class Photo
 * @package App\Models
 */
class Photo extends BaseModel
{
    /**
     * @var string $_table
     */
    protected $_table = 'photos';

    /**
     * @param int $galleryId
     * @return array
     */
    public function allForGallery($galleryId)
    {
        $photos = $this->_storageInterface->name($this->_table)->read();
        $sortedForGallery = [];
        foreach ($photos as $photo) {
            if ($photo->gallery_id === $galleryId) {
                $sortedForGallery[] = $photo;
            }
        }

        return array_reverse($sortedForGallery);
    }
}