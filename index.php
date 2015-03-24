<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ^ E_DEPRECATED);
ini_set('display_errors', '1');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) .  DS);
define('CORE_PATH', ROOT. 'core'. DS);
define('APP_PATH', ROOT. 'app'. DS );

//echo Hash::getHash('sha1','fantomas',HASH_KEY);exit;

try {
    require_once CORE_PATH . 'Config.php';
    require_once CORE_PATH . 'Request.php';
    require_once CORE_PATH . 'Bootstrap.php';
    require_once CORE_PATH . 'Controller.php';
    require_once CORE_PATH . 'Model.php';
    require_once CORE_PATH . 'View.php';
    require_once CORE_PATH . 'Register.php';
    require_once CORE_PATH . 'Database.php';
    require_once CORE_PATH . 'Session.php';
    require_once CORE_PATH . 'Hash.php';

    Session::init();

    Bootstrap::run(new Request);
}
catch (Exception $e) {
    echo $e->getMessage();
}