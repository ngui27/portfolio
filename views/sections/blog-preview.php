<section id="blog">
  <div class="sh">
    <p class="sl">Ressources</p>
    <h2 class="st">Articles SEO &amp; GEO</h2>
    <p class="ss">Conseils pratiques pour être trouvé sur Google et sur les IA de recherche.</p>
  </div>
  <div class="blog-preview-grid">
    <?php foreach ($latestArticles as $a): ?>
    <article class="blog-preview-card">
      <div class="blog-card-meta">
        <span class="blog-tag"><?= htmlspecialchars($a['category']) ?></span>
        <span class="blog-read"><?= (int)$a['read_time'] ?> min</span>
      </div>
      <h3><a href="/blog/<?= htmlspecialchars($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a></h3>
      <p><?= htmlspecialchars($a['excerpt']) ?></p>
      <a href="/blog/<?= htmlspecialchars($a['slug']) ?>" class="blog-card-link">Lire →</a>
    </article>
    <?php endforeach; ?>
  </div>
  <div class="blog-preview-cta">
    <a href="/blog" class="btn-outline">Voir tous les articles →</a>
  </div>
</section>
