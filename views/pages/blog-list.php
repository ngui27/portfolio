<section class="blog-hero">
  <div class="sh">
    <p class="sl">Ressources</p>
    <h1 class="st">Blog SEO &amp; GEO</h1>
    <p class="ss">Conseils pratiques pour développeurs et entrepreneurs qui veulent être trouvés sur Google — et sur les IA de recherche.</p>
  </div>
</section>

<section class="blog-list">
  <?php foreach ($articles as $a): ?>
  <article class="blog-card">
    <div class="blog-card-meta">
      <span class="blog-tag"><?= htmlspecialchars($a['category']) ?></span>
      <span class="blog-date"><?= date('j F Y', strtotime($a['date'])) ?></span>
      <span class="blog-read"><?= (int)$a['read_time'] ?> min de lecture</span>
    </div>
    <h2 class="blog-card-title">
      <a href="/blog/<?= htmlspecialchars($a['slug']) ?>"><?= htmlspecialchars($a['title']) ?></a>
    </h2>
    <p class="blog-card-excerpt"><?= htmlspecialchars($a['excerpt']) ?></p>
    <a href="/blog/<?= htmlspecialchars($a['slug']) ?>" class="blog-card-link">Lire l'article →</a>
  </article>
  <?php endforeach; ?>
</section>
