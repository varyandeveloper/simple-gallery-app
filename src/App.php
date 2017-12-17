<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 14.12.2017
 * Time: 14:31
 */

namespace VS\Gallery;

/**
 * Class App
 */
class App
{
    /**
     * @var App $_instance
     */
    private static $_instance;

    /**
     * @return App
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        $url = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $url = ltrim(stripcslashes($_SERVER['PATH_INFO']), '/');
        }

        $partials = explode('/', $url);

        $controller = $partials[0];
        unset($partials[0]);

        if (empty($controller)) {
            $controller = $this->getConfig('defaultController');
        }
        $controllerName = 'App\\Controllers\\' . str_replace('Controller', '', $controller);

        if (!class_exists($controllerName)) {
            throw new \Exception('Class ' . $controllerName . ' dose not exists.');
        } else {
            $controller = new $controllerName();
        }

        $method = 'index';
        if (!empty($partials[1])) {
            $method = $partials[1];
            unset($partials[1]);
        }

        if (!method_exists($controller, $method)) {
            throw new \Exception('The controller ' . $controllerName . ' dose not have ' . $method . ' method');
        }

        $params = array_values($partials);

        session_start();

        $result = !empty($params)
            ? call_user_func_array([$controller, $method], $params)
            : call_user_func([$controller, $method]);

        if (is_string($result)) {
            print $result;
        } else {
            exit('Nothing to show');
        }
    }

    /**
     * @param string $add
     * @return string
     */
    public static function url($add = '')
    {
        if (!$_SERVER['SCRIPT_NAME']) {
            $url = self::getInstance()->getConfig('baseUrl');
        } else {
            $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://';
            $url .= rtrim($_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/') . '/';
        }
        return $url . ltrim($add, '/');
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getConfig($key = null)
    {
        static $config;
        if (!$config) {
            $config = require_once APP . 'config.php';
        }

        if (null !== $key) {
            return isset($config[$key]) ? $config[$key] : null;
        }

        return $config;
    }

    /**
     * Make object SingleTon
     * App constructor.
     */
    private function __construct()
    {
    }

    /**
     * Prevent object cloning
     * App clone.
     */
    private function __clone()
    {

    }
}