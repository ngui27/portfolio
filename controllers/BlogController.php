<?php

require_once __DIR__ . '/../models/ArticleModel.php';

class BlogController
{
    public function list(): void
    {
        $articles = (new ArticleModel())->getAll();

        $page_title       = 'Blog SEO & GEO — YéliDev';
        $page_description = 'Conseils SEO technique, référencement local et GEO pour les entrepreneurs et développeurs au Québec. Articles par YéliDev.';
        $page_canonical   = 'https://yelidev.ca/blog';
        $page_og_type     = 'website';

        require __DIR__ . '/../views/layout/head.php';
        require __DIR__ . '/../views/sections/nav.php';
        require __DIR__ . '/../views/pages/blog-list.php';
        require __DIR__ . '/../views/sections/footer.php';
        require __DIR__ . '/../views/layout/end.php';
    }

    public function show(string $slug): void
    {
        $article = (new ArticleModel())->getBySlug($slug);

        if ($article === null) {
            http_response_code(404);
            require __DIR__ . '/../views/layout/head.php';
            require __DIR__ . '/../views/sections/nav.php';
            require __DIR__ . '/../views/pages/404.php';
            require __DIR__ . '/../views/sections/footer.php';
            require __DIR__ . '/../views/layout/end.php';
            return;
        }

        $page_title       = $article['title'] . ' — YéliDev';
        $page_description = $article['excerpt'];
        $page_canonical   = 'https://yelidev.ca/blog/' . $article['slug'];
        $page_og_type     = 'article';

        require __DIR__ . '/../views/layout/head.php';
        require __DIR__ . '/../views/sections/nav.php';
        require __DIR__ . '/../views/pages/blog-article.php';
        require __DIR__ . '/../views/sections/footer.php';
        require __DIR__ . '/../views/layout/end.php';
    }
}
