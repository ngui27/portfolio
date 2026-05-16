<?php
$projectsDesign = [
  [
    'num'   => '01',
    'year'  => '2025',
    'type'  => 'WordPress · ACF',
    'kanji' => '家',
    'url'   => 'https://kocoonfamily.fr',
    'label' => 'Voir le site',
  ],
  [
    'num'   => '02',
    'year'  => '2024',
    'type'  => 'Symfony · API',
    'kanji' => '酒',
    'url'   => 'https://gestibar.ca',
    'label' => 'Voir l\'app',
  ],
];
?>
<section id="projets" class="section">
  <div class="container">
    <div class="projects-header reveal">
      <div>
        <div class="section-eyebrow">Réalisations <span class="kanji">作品</span></div>
        <h2 class="section-title">
          Du code propre,<br>livré avec <em style="color:var(--vermillion);font-style:italic">soin</em>.
        </h2>
      </div>
      <p style="max-width:380px;color:var(--muted);font-size:16px;line-height:1.6">
        Deux projets récents — l'un pour une marque montréalaise, l'autre
        pour un réseau d'établissements. Discutons du vôtre.
      </p>
    </div>

    <?php foreach ($projects as $i => $p):
      $d = $projectsDesign[$i] ?? ['num' => '0'.($i+1), 'year' => '2025', 'type' => '', 'kanji' => '仕', 'url' => $p['url'], 'label' => $p['link_label']];
    ?>
    <article class="project <?= $i % 2 === 1 ? 'reverse' : '' ?> reveal">
      <div class="project-visual">
        <div class="project-visual-sun"></div>
        <div class="project-visual-frame"></div>
        <div class="project-visual-kanji"><?= htmlspecialchars($d['kanji']) ?></div>
        <div class="project-visual-label">[ Capture — <?= htmlspecialchars($p['title']) ?> ]</div>
      </div>
      <div>
        <div class="project-meta">
          <span class="num"><?= htmlspecialchars($d['num']) ?> / <?= count($projects) ?></span>
          <span><?= htmlspecialchars($d['year']) ?></span>
          <span><?= htmlspecialchars($d['type'] ?: $p['type']) ?></span>
        </div>
        <h3 class="project-title"><?= htmlspecialchars($p['title']) ?></h3>
        <p class="project-desc"><?= htmlspecialchars($p['desc']) ?></p>
        <div class="project-stack">
          <?php foreach ($p['techs'] as $tech): ?>
          <span class="tag"><?= htmlspecialchars($tech) ?></span>
          <?php endforeach; ?>
        </div>
        <a href="<?= htmlspecialchars($p['url']) ?>" target="_blank" rel="noopener" class="project-link">
          <?= htmlspecialchars($p['link_label']) ?>
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>
