<?php

class errorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->title = 'Error';
        $this->_view->message = $this->_getError();
        $this->_view->render('index');
    }

    public function access($code)
    {
        $this->_view->title = 'Error';
        $this->_view->message = $this->_getError($code);
        $this->_view->render('access');
    }

    private function _getError($code = false)
    {
        if($code) {
            $code = $this->filterInt($code);
            if(is_int($code))
                $code = $code;
        }
        else {
            $code = 'default';
        }

        $code = $this->filterInt($code);

        $error['default'] = 'default error';
        $error['5050'] = 'Nepovolený přístup';

        if (array_key_exists($code, $error)) {
            return $error[$code];
        }
        else {
            return $error['default'];
        }
    }
}