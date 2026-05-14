<article class="article-wrap">

  <header class="article-header">
    <a href="/blog" class="article-back">← Retour au blog</a>
    <div class="article-meta">
      <span class="blog-tag"><?= htmlspecialchars($article['category']) ?></span>
      <span class="blog-date"><?= date('j F Y', strtotime($article['date'])) ?></span>
      <span class="blog-read"><?= (int)$article['read_time'] ?> min de lecture</span>
    </div>
    <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
    <p class="article-excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
  </header>

  <div class="article-body">
    <?= $article['content'] ?>
  </div>

  <footer class="article-footer">
    <p>Vous avez des questions sur le SEO ou le GEO de votre site ?</p>
    <a href="/#contact" class="btn-primary">Discutons de votre projet →</a>
  </footer>

</article>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": <?= json_encode($article['title']) ?>,
  "description": <?= json_encode($article['excerpt']) ?>,
  "datePublished": "<?= htmlspecialchars($article['date']) ?>",
  "author": {
    "@type": "Person",
    "name": "YéliDev",
    "url": "https://yelidev.ca/"
  },
  "publisher": {
    "@type": "Person",
    "name": "YéliDev",
    "url": "https://yelidev.ca/"
  },
  "url": "https://yelidev.ca/blog/<?= htmlspecialchars($article['slug']) ?>"
}
</script>
