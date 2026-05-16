<?php
$blogImages = [
  '/assets/image/1.jpg',
  '/assets/image/2.jpg',
  '/assets/image/3.jpg',
  '/assets/image/4.jpg',
  '/assets/image/5.png',
  '/assets/image/6.jpg',
];
?>
<section id="blog" class="section">
  <div class="container">
    <div class="jc-header reveal">
      <div>
        <div class="section-eyebrow">Journal <span class="kanji">日記</span></div>
        <h2 class="section-title">
          Quelques notes<br>du <em style="color:var(--vermillion);font-style:italic">quotidien</em>.
        </h2>
      </div>
      <div class="jc-arrows">
        <button class="jc-arrow" id="jc-prev" aria-label="Article précédent">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        </button>
        <button class="jc-arrow" id="jc-next" aria-label="Article suivant">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 19l7-7-7-7"/></svg>
        </button>
      </div>
    </div>

    <div class="jc-track-wrap">
      <div class="jc-track" id="jc-track">
        <?php foreach ($latestArticles as $i => $a):
          $img = $blogImages[$i % count($blogImages)];
          $excerpt = mb_strlen($a['excerpt']) > 110 ? mb_substr($a['excerpt'], 0, 110).'…' : $a['excerpt'];
          $titleShort = mb_strlen($a['title']) > 70 ? mb_substr($a['title'], 0, 70).'…' : $a['title'];
        ?>
        <div class="jc-card reveal" data-delay="<?= $i + 1 ?>"
             data-slug="<?= htmlspecialchars($a['slug']) ?>"
             data-title="<?= htmlspecialchars($a['title']) ?>"
             data-cat="<?= htmlspecialchars($a['category']) ?>"
             data-date="<?= date('j F Y', strtotime($a['date'])) ?>"
             data-read="<?= (int)$a['read_time'] ?>"
             data-excerpt="<?= htmlspecialchars($a['excerpt']) ?>"
             data-img="<?= $img ?>">
          <!-- Fond image -->
          <div class="jc-card-bg">
            <img src="<?= $img ?>" alt="" aria-hidden="true">
          </div>
          <!-- Contenu -->
          <div class="jc-card-body">
            <div class="jc-card-meta">
              <span class="jc-cat"><?= htmlspecialchars($a['category']) ?></span>
              <span><?= date('j M Y', strtotime($a['date'])) ?></span>
            </div>
            <div class="jc-quote-icon">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            </div>
            <p class="jc-card-excerpt"><?= htmlspecialchars($excerpt) ?></p>
            <p class="jc-card-title"><?= htmlspecialchars($titleShort) ?></p>
            <p class="jc-card-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="blog-preview-cta reveal" data-delay="4">
      <a href="/blog" class="btn btn-ghost">Voir tous les articles →</a>
    </div>
  </div>
</section>

<!-- Overlay expandé (même principe que le composant React) -->
<div class="jc-overlay" id="jc-overlay" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="jc-overlay-inner" id="jc-overlay-inner">
    <button class="jc-overlay-close" id="jc-overlay-close" aria-label="Fermer">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <div class="jc-overlay-bg" id="jc-overlay-bg"></div>
    <div class="jc-overlay-content">
      <p class="jc-overlay-cat" id="jc-overlay-cat"></p>
      <p class="jc-overlay-date" id="jc-overlay-date"></p>
      <div class="jc-overlay-quote">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
      </div>
      <p class="jc-overlay-excerpt" id="jc-overlay-excerpt"></p>
      <h3 class="jc-overlay-title" id="jc-overlay-title"></h3>
      <a href="#" class="btn btn-primary jc-overlay-link" id="jc-overlay-link">
        Lire l'article <span class="arrow">→</span>
      </a>
    </div>
  </div>
</div>
