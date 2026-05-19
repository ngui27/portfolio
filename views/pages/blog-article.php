<article class="article-wrap">

  <header class="article-header">
    <a href="/blog" class="article-back">← Retour au blog</a>
    <div class="article-meta">
      <span class="blog-tag"><?= htmlspecialchars($article['category']) ?></span>
      <span>Publié le <?= date('j F Y', strtotime($article['date'])) ?></span>
      <?php if (!empty($article['date_updated']) && $article['date_updated'] !== $article['date']): ?>
      <span>Mis à jour le <?= date('j F Y', strtotime($article['date_updated'])) ?></span>
      <?php endif; ?>
      <span><?= (int)$article['read_time'] ?> min de lecture</span>
    </div>
    <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
    <p class="article-excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
  </header>

  <?php if (!empty($article['cover_image'])): ?>
  <div class="article-hero">
    <img
      src="<?= htmlspecialchars($article['cover_image']) ?>"
      alt="<?= htmlspecialchars($article['title']) ?>"
      width="1730"
      height="910"
      loading="eager"
      fetchpriority="high"
      decoding="sync"
    >
  </div>
  <?php endif; ?>

  <div class="article-body">
    <?= $article['content'] ?>
  </div>

  <div class="article-author">
    <img src="/assets/image/profil.png" alt="Photo de YéliDev, développeur web à Montréal" class="article-author-avatar" width="64" height="64" loading="lazy">
    <div class="article-author-info">
      <span class="article-author-name">YéliDev</span>
      <span class="article-author-bio">Développeur web à Montréal. Je construis des sites vitrines et applications web pour PME et entrepreneurs au Québec, avec un focus SEO et performance.</span>
    </div>
  </div>

  <?php if (!empty($prev_article) || !empty($next_article)): ?>
  <nav class="article-nav" aria-label="Navigation entre articles">
    <div class="article-nav-inner">
      <?php if (!empty($prev_article)): ?>
      <a href="/blog/<?= htmlspecialchars($prev_article['slug']) ?>" class="article-nav-link article-nav-prev">
        <span class="article-nav-label">← Article précédent</span>
        <span class="article-nav-title"><?= htmlspecialchars($prev_article['title']) ?></span>
      </a>
      <?php else: ?>
      <div></div>
      <?php endif; ?>

      <?php if (!empty($next_article)): ?>
      <a href="/blog/<?= htmlspecialchars($next_article['slug']) ?>" class="article-nav-link article-nav-next">
        <span class="article-nav-label">Article suivant →</span>
        <span class="article-nav-title"><?= htmlspecialchars($next_article['title']) ?></span>
      </a>
      <?php endif; ?>
    </div>
  </nav>
  <?php endif; ?>

  <footer class="article-footer">
    <p>Vous avez des questions sur le SEO ou le GEO de votre site ?</p>
    <a href="/#contact" class="btn btn-primary">Discutons de votre projet →</a>
  </footer>

</article>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://yelidev.ca/blog/<?= htmlspecialchars($article['slug']) ?>"
  },
  "headline": <?= json_encode($article['title']) ?>,
  "description": <?= json_encode($article['excerpt']) ?>,
  "image": <?= json_encode($article['og_image'] ?? 'https://yelidev.ca/assets/image/og-preview.png') ?>,
  "datePublished": "<?= htmlspecialchars($article['date']) ?>",
  "dateModified": "<?= htmlspecialchars($article['date_updated'] ?? $article['date']) ?>",
  "keywords": <?= json_encode($article['keywords'] ?? '') ?>,
  "articleSection": <?= json_encode($article['category']) ?>,
  "inLanguage": "fr-CA",
  "author": {
    "@type": "Person",
    "name": "YéliDev",
    "url": "https://yelidev.ca/",
    "image": "https://yelidev.ca/assets/image/profil.png",
    "jobTitle": "Développeur Web",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Montréal",
      "addressRegion": "QC",
      "addressCountry": "CA"
    }
  },
  "publisher": {
    "@type": "Person",
    "name": "YéliDev",
    "url": "https://yelidev.ca/",
    "image": "https://yelidev.ca/assets/image/profil.png"
  },
  "url": "https://yelidev.ca/blog/<?= htmlspecialchars($article['slug']) ?>"
}
</script>
