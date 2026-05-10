<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'contact') {
    require_once __DIR__ . '/controllers/ContactController.php';
    (new ContactController())->send();
} else {
    require_once __DIR__ . '/controllers/HomeController.php';
    (new HomeController())->index();
}
