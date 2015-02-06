<?php

class errorController extends Controller
{
    public function __construct()
    {
        parents::__construct();
    }

    public function index()
    {

    }

    private function _getError($code)
    {
        $code = $this->filterInt($code);
    }
}