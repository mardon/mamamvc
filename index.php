<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '1');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) .  DS);
define('CORE_PATH', ROOT. 'core'. DS);
define('APP_PATH', ROOT. 'app'. DS );

require_once CORE_PATH . 'Config.php';
require_once CORE_PATH . 'Request.php';
require_once CORE_PATH . 'Bootstrap.php';
require_once CORE_PATH . 'Controller.php';
require_once CORE_PATH . 'Model.php';
require_once CORE_PATH . 'View.php';
require_once CORE_PATH . 'Register.php';
require_once CORE_PATH . 'Database.php';

try {
    Bootstrap::run(new Request);
}
catch (Exception $e) {
    echo $e->getMessage();
}