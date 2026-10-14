<?php
require __DIR__ . '/app/bootstrap.php';

$basePath = '/network-study';
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$uri = '/' . trim($uri, '/');
if ($uri === '//') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    $controller = null;

    if ($uri === '/' && $method === 'GET') {
        $controller = new DashboardController();
        $controller->index();
        exit;
    }

    if ($uri === '/courses' && $method === 'GET') {
        $controller = new CourseController();
        $controller->index();
        exit;
    }

    if ($uri === '/courses/new' && $method === 'GET') {
        $controller = new CourseController();
        $controller->createForm();
        exit;
    }

    if ($uri === '/courses/create' && $method === 'POST') {
        $controller = new CourseController();
        $controller->store();
        exit;
    }

    if (preg_match('#^/courses/(\d+)$#', $uri, $matches) && $method === 'GET') {
        $controller = new CourseController();
        $controller->show((int) $matches[1]);
        exit;
    }

    if (preg_match('#^/lessons/(\d+)$#', $uri, $matches) && $method === 'GET') {
        $controller = new LessonController();
        $controller->show((int) $matches[1]);
        exit;
    }

    if (preg_match('#^/lessons/(\d+)/save-note$#', $uri, $matches) && $method === 'POST') {
        $controller = new LessonController();
        $controller->saveNote((int) $matches[1]);
        exit;
    }

    http_response_code(404);
    echo '<h1>404 - Page not found</h1>';
} catch (Throwable $e) {
    http_response_code(500);
    echo '<h1>Application error</h1>';
    echo '<pre>' . e($e->getMessage()) . '</pre>';
}
