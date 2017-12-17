<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:42
 */

namespace App\Controllers;

use App\Models\User;
use VS\Gallery\App;
use VS\Gallery\BaseController;

/**
 * Class Gallery
 * @package App\Controllers
 */
class Gallery extends BaseController
{
    /**
     * @return int
     * @throws \Exception
     */
    public function index()
    {
        $model = new \App\Models\Gallery();
        $galleries = $model->all();
        return $this->view('gallery/index', compact('galleries'));
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        $this->_checkPermission();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new \App\Models\Gallery();
            $data = [
                'id' => $model->getMaxId() + 1,
                'user_id' => $_SESSION['user_id'],
                'name' => $_POST['name']
            ];
            if ($model->add($data)) {
                header('Location: ' . App::url('gallery'));
            }
        } else {
            return $this->view('gallery/create');
        }
    }

    /**
     * @param null $id
     * @return string
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $galleryModel = new \App\Models\Gallery();
        $gallery = $galleryModel->find($id);
        if (!$gallery) {
            throw new \Exception('Gallery not found');
        }
        return $this->view('gallery/edit', compact('gallery'));
    }

    /**
     * @param int $id
     */
    public function update($id)
    {
        $this->_checkPermission();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galleryModel = new \App\Models\Gallery();
            if($galleryModel->update($id, $_POST))
            {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Gallery updated successfully.";
                header('Location: '.App::url('gallery'));
            }else{
                $_SESSION['status'] = 'danger';
                $_SESSION['message'] = "Can't update gallery.";
                header('Location: '.App::url('gallery/edit/'.$id));
            }
        }
    }

    /**
     * @param int $galleryId
     */
    public function remove($galleryId)
    {
        $userModel = new User();

        if (!$userModel->hasRole('editor')) {
            $_SESSION['status'] = 'danger';
            $_SESSION['message'] = "You don't have permission for this action";
            header('Location: ' . App::url('gallery'));
        } else {
            $model = new \App\Models\Gallery();
            $removed = $model->remove($galleryId);

            if ($removed) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Gallery removed successfully.";
            }

            header('Location: ' . App::url('gallery'));
        }
    }
}