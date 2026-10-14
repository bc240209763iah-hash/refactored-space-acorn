<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

$config = require APP_ROOT . '/config/config.php';

require_once APP_ROOT . '/app/helpers.php';
require_once APP_ROOT . '/app/core/Database.php';
require_once APP_ROOT . '/app/core/View.php';
require_once APP_ROOT . '/app/controllers/BaseController.php';
require_once APP_ROOT . '/app/controllers/DashboardController.php';
require_once APP_ROOT . '/app/controllers/CourseController.php';
require_once APP_ROOT . '/app/controllers/LessonController.php';

if (!is_dir($config['uploads'])) {
    mkdir($config['uploads'], 0777, true);
}
