<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 14:57
 */

namespace VS\Gallery;

/**
 * Class BaseController
 * @package VS\Gallery
 */
abstract class BaseController
{
    /**
     * @param string $name
     * @param array $args
     * @throws \Exception
     * @return string
     */
    public function view($name, $args = [])
    {
        $viewFile = APP . 'views/' . $name . '.php';

        if (!is_file($viewFile)) {
            throw new \Exception('view with name ' . $name . ' not found.');
        }

        extract($args);
        ob_start();
        include $viewFile;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     *
     */
    protected function _checkPermission()
    {
        if(empty($_SESSION['is_logged_in'])){
            header('Location: '.App::url('auth/login'));
        }elseif (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'editor'){
            $_SESSION['status'] = 'danger';
            $_SESSION['message'] = "You don't have permission for this action";
            header('Location: '.App::url('/'));
        }
    }
}