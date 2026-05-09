<?php

require_once __DIR__ . '/../models/ProjectModel.php';

class HomeController
{
    public function index(): void
    {
        $projects = (new ProjectModel())->getAll();

        require __DIR__ . '/../views/layout/head.php';
        require __DIR__ . '/../views/sections/nav.php';
        require __DIR__ . '/../views/sections/hero.php';
        require __DIR__ . '/../views/sections/services.php';
        require __DIR__ . '/../views/sections/projects.php';
        require __DIR__ . '/../views/sections/why.php';
        require __DIR__ . '/../views/sections/contact.php';
        require __DIR__ . '/../views/sections/footer.php';
        require __DIR__ . '/../views/layout/end.php';
    }
}
