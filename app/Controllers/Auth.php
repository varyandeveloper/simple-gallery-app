<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 17:48
 */

namespace App\Controllers;

use App\Models\User;
use VS\Gallery\App;
use VS\Gallery\BaseController;

/**
 * Class Auth
 * @package App\Controllers
 */
class Auth extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $name = $_POST['name'];
            $model = new User();
            $exists = $model->doLogin($name);
            if(!$exists){
                $_SESSION['status'] = 'danger';
                $_SESSION['message'] = 'Invalid credentials';
                header('Location: '.App::url('auth/login'));
            }else{
                header('Location: '.App::url('/'));
            }
        }else{
            if(!empty($_SESSION['is_logged_in'])){
                header('Location: '.App::url('/'));
            }
            return $this->view('auth/login');
        }
    }

    /**
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: ' . App::url());
    }
}