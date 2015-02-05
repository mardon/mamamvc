<?php

class View
{
    private $_controller;
    private $_js;

    public function __construct (Request $request) {
        $this->_controller = $request->getController();
        $this->_js = array();
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

        $js = array();

        if (count($this->_js)) {
          $js = $this->_js;
        };
        $_layoutParams = array(
            'root_css' => BASE_URL. 'public/css/style.css',
            'root_img' => BASE_URL. 'public/img/',
            'root_js' => BASE_URL. 'public/js/',
            'menu' => $menu,
            'js' => $js
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

    public function setJs (array $js) {
        if(is_array($js) && count($js)) {
            for($i=0; $i < count($js); $i++) {
                $this->_js[] = BASE_URL . 'app' . DS . 'Views' .DS. $this->_controller . DS. 'js' . DS. $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error js');
        }
    }

}