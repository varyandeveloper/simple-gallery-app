<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 14:53
 */

namespace App\Controllers;

use VS\Gallery\BaseController;

/**
 * Class Home
 * @package App\Controller
 */
class Home extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        return $this->view('home', ['title' => 'Home']);
    }
}