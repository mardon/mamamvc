<?php

class Session
{
    public static function init()
    {
        session_start();
    }

    public static function destroy($value = false)
    {
        if($value)
        {
            if(is_array($value))
            {
                for($i=0; $i < count($value); $i++)
                {
                    if(isset($_SESSION[$value[$i]])){
                        session_unset($_SESSION[$value[$i]]);
                    }
                }
            }
            else {
                if(isset($_SESSION[$value])){
                    session_unset($_SESSION[$value]);
                }
            }
        }
        else {
            session_destroy();
        }
    }

    public static function set($id, $value)
    {
        if (!empty($id))
            $_SESSION[$id] = $value;
    }

    public static function get($id)
    {
        if(isset($_SESSION[$id]))
            return $_SESSION[$id];
    }

    public static function access($level)
    {
        if(!Session::get('authentication')) {
            header('location:' .BASE_URL . 'error/access/5050');
            exit;
        }

        Session::time();

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            header('location:' .BASE_URL . 'error/access/5050');
            exit;
        }
    }

    public static function accesView($level) {
        if(!Session::get('authentication')) {
            return false;
        }

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            return false;
        }

        return true;
    }

    public static function getLevel($level)
    {
        $role['admin'] = 3;
        $role['special'] = 2;
        $role['basic'] =1;

        if(!array_key_exists($level, $role)) {
            throw new Exception('Chyba přístupu');
        }
        else {
            return $role['level'];
        }
    }

    public static function accessRestrict (array $level, $noAdmin = false)
    {
        if(!Session::get('authentication')) {
            header('location:' . BASE_URL .'error/access/5050');
            exit;
        }

        Session::time();

        if($noAdmin == false)
            if(Session::get('level') == 'admin') {
                return;
            }

        if(count($level)) {
            if(in_array(Session::get('level'), $level)) {
                return;
            }
        }

        header('location:' . BASE_URL .'error/access/5050');
    }

    public static function accessViewRestrict (array $level, $noAdmin = false)
    {
        if(!Session::get('authentication')) {
            return false;
        }

        if($noAdmin == false)
            if(Session::get('level') == 'admin') {
                return true;
            }

        if(count($level)) {
            if(in_array(Session::get('level'), $level)) {
                return true;
            }
        }

        return false;
    }

    public static function time()
    {
        if(!Session::get('time') || !defined('SESSION_TIME')) {
            throw new Exception('Není definován čas pro session');
        }

        if (SESSION_TIME == 0) {
            return;
        }

        if (time() - Session::get('time') > (SESSION_TIME * 60 )) {
            Session::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
            exit;
        }
        else {
            Session::set('time', time());
        }
    }

}