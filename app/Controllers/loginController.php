<?php

class loginController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index () {

        $this->_view->tile = "Přihlašení";

        if ($this->getInt($enviar) == 1) {
            $this->data = $_POST;
            Session::set('authentication', true);
            Session::set('level', 'user');
            Session::set('time', time());
        }

        $this->_view->render('index','login');

    }


    public function logout()
    {
        Session::destroy();
        $this->redirect('');
    }
}