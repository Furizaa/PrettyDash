<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../src/application'));

// Define path to test fixtures
defined('TEST_FIXTURE_PATH')
    || define('TEST_FIXTURE_PATH', realpath(dirname(__FILE__) . '/files'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/..'),
    get_include_path(),
)));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

require_once 'Zend/Application.php';
$app = new Zend_Application('testing', APPLICATION_PATH . '/configs/application.ini');
$app->bootstrap();
