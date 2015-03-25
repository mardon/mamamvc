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

            $this->getLibrary('class.phpmailer');
            $mail = new PHPMailer();


            $this->_register->registerUser(
                $this->getSql('name'),
                $this->getAlphaNum('user'),
                $this->getSql('pass'),
                $this->getPostParam('email')
            );

            $user = $this->_register->verifyUser($this->getAlphaNum('user'));

            if(!$user) {
                $this->_view->_error = 'Registrace se nezdařila';
                $this->_view->render('index', 'register');
                exit;
            }

            $mail->From = 'Test mvc';
            $mail->FromName = 'Tutorial';
            $mail->Subject = 'Aktivační mail';
            $mail->Body = 'Ahoj <strong> '. $this->getSql('name') . '</strong>' .
                            '<p>Registrace na webu prosím aktivujte</p>' .
                            '<a href="'.BASE_URL .'register/activate/'.
                            $user['id'] . '/' . $user['code'] . '">'.
                            BASE_URL . 'register/activate/' .
                            $user['id'] . '/' . $user['code'] . '</a>';
            $mail->AltBody = 'mail je v html';
            $mail->addAddress($this->getPostParam('email'));
            $mail->send();

            $this->_view->data = false;
            $this->_view->_message = 'Registrace provedena zkontrolujte si mail';
        }
        $this->_view->render('index', 'register');
    }

    public function activate($id, $code)
    {
        if(!$this->filterInt($id) || !$this->filterInt($code)) {
            $this->_view->_error = 'Účet neexistuje';
            $this->_view->render('activate', 'register');
            exit;
        }

        $row = $this->_register->getUser(
            $this->filterInt($id),
            $this->filterInt(code)
        );

        if(!$row) {
            $this->_view->_error = 'Účet neexistuje';
            $this->_view->render('activate', 'register');
            exit;
        }

        if(!$row['stav'] == 1) {
            $this->_view->_error = 'Účet neexistuje';
            $this->_view->render('activate', 'register');
            exit;
        }

        $this->_register->activateUser(
            $this->filterInt($id),
            $this->filterInt(code)
        );

        $row = $this->_register->getUser(
            $this->filterInt($id),
            $this->filterInt(code)
        );

        if($row['stav'] == 0) {
            $this->_view->_error = 'Chyba při aktivaci uživatele';
            $this->_view->render('activate', 'register');
            exit;
        }

        $this->_view->_message = 'Uživatel byl aktiviván';
    }
}