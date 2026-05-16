<section id="blog" class="section">
  <div class="container">
    <div class="reveal">
      <div class="section-eyebrow">Journal <span class="kanji">日記</span></div>
      <h2 class="section-title">
        Quelques notes<br>du <em style="color:var(--vermillion);font-style:italic">quotidien</em>.
      </h2>
    </div>
    <div class="blog-grid">
      <?php foreach ($latestArticles as $i => $a): ?>
      <a href="/blog/<?= htmlspecialchars($a['slug']) ?>" class="blog-card reveal" data-delay="<?= $i + 1 ?>">
        <div class="blog-cover">
          <div class="blog-cover-sun"></div>
          <div class="blog-cover-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
        </div>
        <div class="blog-meta">
          <span class="cat"><?= htmlspecialchars($a['category']) ?></span>
          <span><?= date('j M Y', strtotime($a['date'])) ?></span>
          <span><?= (int)$a['read_time'] ?> min</span>
        </div>
        <h3 class="blog-title"><?= htmlspecialchars($a['title']) ?></h3>
        <p class="blog-excerpt"><?= htmlspecialchars($a['excerpt']) ?></p>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="blog-preview-cta reveal" data-delay="4">
      <a href="/blog" class="btn btn-ghost">Voir tous les articles →</a>
    </div>
  </div>
</section>
