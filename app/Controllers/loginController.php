<?php

class loginController extends Controller
{
    private $_login;
    public function __construct() {
        parent::__construct();
        $this->_login = $this->loadModel('login');
    }

    public function index () {

        $this->_view->title = "Přihlašení";

        if ($this->getInt('enviar') == 1) {
            $this->_view->data = $_POST;

            if(!$this->getAlphaNum('user')) {
                $this->_view->_error = 'Není zadáno správné jméno';
                $this->_view->render('index', 'login');
                exit;
            }

            if(!$this->getSql('pass')) {
                $this->_view->_error = 'Není zadáno správné heslo';
                $this->_view->render('index', 'login');
                exit;
            }

            $row = $this->_login->getUser(
                $this->getAlphaNum('user'),
                $this->getSql('pass')
            );

            if(!$row) {
                $this->_view->_error = 'Přihlášení se nezdařilo';
                $this->_view->render('index', 'login');
                exit;
            }

            if($row['state'] != 1 ) {
                $this->_view->_error = 'Uživatel neaktivní';
                $this->_view->render('index', 'login');
                exit;
            }

            Session::set('authentication', true);
            Session::set('level', $row['role']);
            Session::set('user', $row['user']);
            Session::set('id_user', $row['id']);
            Session::set('time', time());

            $this->redirect('');
        }

        $this->_view->render('index','login');

    }


    public function logout()
    {
        Session::destroy();
        $this->redirect('');
    }
}