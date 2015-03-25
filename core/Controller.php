<?php

abstract class Controller
{
    protected $_view;

    public function __construct() {
        $this->_view = new View(new Request);
    }

    abstract public function index();

    protected function loadModel($model)
    {
        $model = $model . 'Model';
        $rootModel = ROOT . 'app' . DS . 'Models'. DS . $model . '.php';

        if(is_readable($rootModel)) {
            require_once $rootModel;
            $model = new $model;
            return $model;
        }
        else {
            throw new Exception('Error de model');
        }
    }

    protected function getLibrary($lib) {
        $rootlib =  ROOT . 'lib' . DS . $lib . '.php';

        if (is_readable($rootlib)) {
            require_once $rootlib;
        }
        else {
            throw new Exception('Error library');
        }
    }

    protected function getText($value)
    {
        if(isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
            return $_POST[$value];
        }

         return '';
    }

    protected function getInt($value)
    {
        if(isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = filter_input(INPUT_POST, $value, FILTER_VALIDATE_INT);
            return $_POST[$value];
        }
        return 0;
    }

    protected function filterInt($int)
    {
        $int = (int) $int;

        if (is_int($int)) {
            return $int;
        }
        else return 0;
    }

    protected function getPostParam($value)
    {
        if(isset($_POST[$value])){
            return $_POST[$value];
        }
    }

    public function redirect($route = false)
    {
        if($route) {
            header('location:' . BASE_URL . $route);
            exit;
        }
        else {
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function getSql($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);

            if(!get_magic_quotes_gpc()){
                $_POST[$clave] = mysql_real_escape_string($_POST[$clave], mysql_connect(DB_HOST, DB_USER, DB_PASS));
            }

            return trim($_POST[$clave]);
        }
    }

    protected function getAlphaNum($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }

    }

    public function validEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}