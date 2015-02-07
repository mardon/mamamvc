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
}