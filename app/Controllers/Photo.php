<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:57
 */

namespace App\Controllers;

use App\Models\User;
use VS\Gallery\App;
use VS\Gallery\BaseController;
use VS\Gallery\Upload;

/**
 * Class Photo
 * @package App\Controllers
 */
class Photo extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        if(empty($_GET['galleryId'])){
            throw new \Exception('Gallery not found');
        }
        $galleryId = $_GET['galleryId'];
        $galleryModel = new \App\Models\Gallery();
        $gallery = $galleryModel->find($galleryId);
        if(empty($gallery)){
            throw new \Exception('Gallery not found');
        }
        $photoModel = new \App\Models\Photo();
        $photos = $photoModel->allForGallery($gallery->id);
        return $this->view('photo/index', compact('gallery','photos'));
    }

    /**
     * @param $photoId
     */
    public function show($photoId)
    {
        $photoModel = new \App\Models\Photo();
        $photoModel->find($photoId);
    }

    /**
     * @return void
     */
    public function upload()
    {
        $upload = new Upload();
        $upload->one('photo');
        $hasErrors = $upload->getError();
        if($hasErrors !== false){

        }else{
            $photoModel = new \App\Models\Photo();
            $data = [
                'id' => $photoModel->getMaxId()+1,
                'gallery_id' => (int)$_POST['gallery_id'],
                'name' => $upload->getName(),
                'path' => 'uploads/'.$upload->getUploadedName()
            ];
            if($photoModel->add($data)){
                header('Location: ' . App::url('photo?galleryId=' . $data['gallery_id']));
            }
        }
    }

    /**
     * @param int $photoId
     */
    public function remove($photoId)
    {
        $userModel = new User();

        if(!$userModel->hasRole('editor')){
            $_SESSION['status'] = 'danger';
            $_SESSION['message'] = "You don't have permission for this action";
            header('Location: ' . App::url('photo?galleryId=' . $_POST['gallery_id']));
        }else{
            $photoModel = new \App\Models\Photo();
            $removed = $photoModel->remove($photoId);

            if($removed){
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Photo removed from gallery";
            }

            header('Location: ' . App::url('photo?galleryId=' . $_POST['gallery_id']));
        }
    }
}