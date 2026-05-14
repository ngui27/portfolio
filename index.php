<?php

session_start();

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'contact') {
    require_once __DIR__ . '/controllers/ContactController.php';
    (new ContactController())->send();
} elseif ($uri === '/blog') {
    require_once __DIR__ . '/controllers/BlogController.php';
    (new BlogController())->list();
} elseif (preg_match('#^/blog/([a-z0-9-]+)$#', $uri, $m)) {
    require_once __DIR__ . '/controllers/BlogController.php';
    (new BlogController())->show($m[1]);
} else {
    require_once __DIR__ . '/controllers/HomeController.php';
    (new HomeController())->index();
}
