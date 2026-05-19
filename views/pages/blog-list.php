<section class="section blog-hero-section">
  <div class="container">
    <div class="reveal">
      <div class="section-eyebrow">Ressources <span class="kanji">資源</span></div>
      <h1 class="section-title">Blog SEO &amp; GEO</h1>
      <p class="section-lede">
        Conseils pratiques pour développeurs et entrepreneurs qui veulent être trouvés sur Google — et sur les IA de recherche.
      </p>
    </div>
    <div class="blog-grid">
      <?php foreach ($articles as $i => $a): ?>
      <a href="/blog/<?= htmlspecialchars($a['slug']) ?>" class="blog-card reveal" data-delay="<?= ($i % 3) + 1 ?>">
        <div class="blog-cover">
          <?php if (!empty($a['cover_image'])): ?>
          <img
            src="<?= htmlspecialchars($a['cover_image']) ?>"
            alt="<?= htmlspecialchars($a['title']) ?>"
            class="blog-cover-img"
            width="1730"
            height="910"
            loading="lazy"
            decoding="async"
          >
          <?php else: ?>
          <div class="blog-cover-sun"></div>
          <div class="blog-cover-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
          <?php endif; ?>
        </div>
        <div class="blog-meta">
          <span class="cat"><?= htmlspecialchars($a['category']) ?></span>
          <span><?= date('j M Y', strtotime($a['date'])) ?></span>
          <span><?= (int)$a['read_time'] ?> min</span>
        </div>
        <h2 class="blog-title"><?= htmlspecialchars($a['title']) ?></h2>
        <p class="blog-excerpt"><?= htmlspecialchars($a['excerpt']) ?></p>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
