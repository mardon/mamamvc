<?php

class postController extends Controller
{
    private $_post;

    public function __construct()
    {
        parent::__construct();
        $this->_post = $this->loadModel('post');
    }

    public function index()
    {
        $this->_view->posts = $this->_post->getPosts();
        $this->_view->title = 'Pots';
        $this->_view->render('index', 'post');
    }

    public function add()
    {
        $this->_view->title = 'Nový post';

        if ($this->getInt('guard') == 1) {
            $this->_view->data = $_POST;

            if(!$this->getText('title')) {
                $this->_view->_error = 'Zadejte název postu';
                $this->_view->render('new', 'post');
                exit;
            }

            if(!$this->getText('post')) {
                $this->_view->_error = 'Zadejte obsah';
                $this->_view->render('new', 'post');
                exit;
            }

            $this->_post->insertPost(
                $this->getText('title'),
                $this->getText('post')
            );

            $this->redirect('post');
        }
        $this->_view->render('new','post');
    }

}