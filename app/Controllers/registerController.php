<?php

class registerController extends Controller  {

    private $_register;

    public function __contruct() {
        parent::__construct();

        $this->_register = $this->loadModel('register');
    }

    public function index()
    {
        if(Session::get('authenticate')) {
            $this->redirect();
        }

        $this->_view->title = 'Registr';

        if($this->getInt('enviar') == 1 ) {
            $this->_view->data = $_POST;

            if(!$this->getSql('name')) {

                $this->_view->_error = 'Zadejte jméno';
                $this->_view->render('index', 'register');
                exit;
            }

            if(!$this->getAlphaNum('user')) {

                $this->_view->_error = 'Zadejte uživatele';
                $this->_view->render('index', 'register');
                exit;
            }

            if($this->_register->verifyUser($this->getAlphaNum('user'))) {
                $this->_view->_error = 'Uživatel ' . $this->getAlphaNum('user') . ' existuje';
                $this->_view->render('index', 'register');
                exit;
            }
        }
        $this->_view->render('index', 'register');
    }
}