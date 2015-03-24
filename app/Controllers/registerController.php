<?php

class registerController extends Controller  {

    private $_register;

    public function __construct() {
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

            if(!$this->validEmail($this->getPostParam('email'))) {

                $this->_view->_error = 'Email není správný';
                $this->_view->render('index', 'register');
                exit;
            }

            if(!$this->getSql('pass')) {
                $this->_view->_error = 'Zadejte heslo';
                $this->_view->render('index', 'register');
                exit;
            }

            if($this->getPostParam('pass') != $this->getPostParam('confirm')) {
                $this->_view->_error = 'Zadané hesla nejsou stejná';
                $this->_view->render('index', 'register');
                exit;
            }

            $this->_register->registerUser(
                $this->getSql('name'),
                $this->getAlphaNum('user'),
                $this->getSql('pass'),
                $this->getPostParam('email')
            );

            if(!$this->_register->verifyUser($this->getAlphaNum('user'))) {
                $this->_view->_error = 'Registrace se nezdařila';
                $this->_view->render('index', 'register');
                exit;
            }

            $this->_view->data = false;
            $this->_view->_message = 'Registrace provedena';
        }
        $this->_view->render('index', 'register');
    }
}