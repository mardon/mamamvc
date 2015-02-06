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
}