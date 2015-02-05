<?php

class View
{
    private $_controller;

    public function __construct (Request $request) {
        $this->_controller = $request->getController();
    }

    public function render($view, $item = false)
    {
        $menu = array(
            array(
                'id' => 'prvni',
                'titulek' => 'Prvni',
                'link' => BASE_URL
            ),

            array(
                'id' => 'druhy',
                'titulek' => 'Druhy',
                'link' => BASE_URL
            ),
        );

        $_layoutParams = array(
            'root_css' => BASE_URL. 'public/css/style.css',
            'root_img' => BASE_URL. 'public/img/',
            'root_js' => BASE_URL. 'public/js/',
            'menu' => $menu
        );

        $routeView = ROOT . 'app'. DS . 'views' . DS . $this->_controller . DS . $view . '.phtml';

        if(is_readable($routeView)) {
            include_once ROOT . DS . 'app'. DS . 'views' .DS . 'layout' . DS . DEFAULT_LAYOUT . DS. 'header.php';
            include_once $routeView;
            include_once ROOT . DS . 'app'. DS . 'views' .DS . 'layout' . DS . DEFAULT_LAYOUT . DS. 'footer.php';
        }

        else {
            throw new Exception('Error: view');
        }
    }

}