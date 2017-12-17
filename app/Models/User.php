<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 15:11
 */

namespace App\Models;

use VS\Gallery\BaseModel;

/**
 * Class User
 * @package App\Models
 */
class User extends BaseModel
{
    /**
     * @var string $_table
     */
    protected $_table = 'users';

    /**
     * @param $name
     * @return bool
     */
    public function doLogin($name)
    {
        $users = $this->all();
        foreach ($users as $user){
            if($user->name === $name){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_role'] = $user->role;
                $_SESSION['user_id'] = $user->id;
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $_SESSION['user_role'] == $roleName;
    }
}