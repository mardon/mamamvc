<?php

class loginController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index () {
        Session::set('authentication', true);
        Session::set('level', 'special');

        Session::set('var1', 'var1');
        Session::set('var2', 'var2');

        $this->redirect('login/mortar');
    }

    public function mortar()
    {
        echo 'Level: '.Session::get('level') . '<br>';
        echo 'Var1: '.Session::get('var1') . '<br>';
        echo 'Var2: '.Session::get('var2') . '<br>';
        echo 'Authentication: '.Session::get('authentication') . '<br>';
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect('login/mortar');
    }
}