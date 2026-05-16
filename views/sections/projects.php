<?php
$projectsDesign = [
  [
    'num'    => '01',
    'year'   => '2025',
    'type'   => 'WordPress · Elementor',
    'kanji'  => '家',
    'url'    => 'https://kocoonfamily.fr',
    'label'  => 'Voir le site',
    'screen' => '/assets/image/ImageProjet/kocoonfamily.png',
  ],
  [
    'num'    => '02',
    'year'   => '2024',
    'type'   => 'Symfony · API',
    'kanji'  => '酒',
    'url'    => 'https://gestibar.ca',
    'label'  => 'Voir l\'app',
    'screen' => '/assets/image/ImageProjet/gestibar.png',
  ],
  [
    'num'    => '03',
    'year'   => '2025',
    'type'   => 'Node.js · SaaS',
    'kanji'  => '宿',
    'url'    => 'https://hostbook.dev',
    'label'  => 'Voir le projet',
    'screen' => '/assets/image/ImageProjet/hostbook.png',
  ],
  [
    'num'    => '04',
    'year'   => '2025',
    'type'   => 'Plugin WordPress',
    'kanji'  => '管',
    'url'    => 'https://kocoonfamily.fr/kocoon-manager',
    'label'  => 'Voir le plugin',
    'screen' => '/assets/image/ImageProjet/kocoonManager.png',
  ],
];
$total = count($projectsDesign);
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
        Quatre projets récents — sites vitrines, applications métier, outils SaaS
        et plugins WordPress. Discutons du vôtre.
      </p>
    </div>

    <?php foreach ($projects as $i => $p):
      $d = $projectsDesign[$i] ?? [
        'num'   => str_pad($i+1, 2, '0', STR_PAD_LEFT),
        'year'  => '2025',
        'type'  => '',
        'kanji' => '仕',
        'url'   => $p['url'],
        'label' => $p['link_label'],
        'screen'=> null,
      ];
    ?>
    <article class="project <?= $i % 2 === 1 ? 'reverse' : '' ?> reveal">

      <?php if (!empty($d['screen'])): ?>
      <!-- Capture réelle avec effet scroll 3D -->
      <div class="cs-container" data-cs>
        <div class="cs-stage">
          <div class="cs-card">
            <div class="cs-card-inner">
              <img src="<?= htmlspecialchars($d['screen']) ?>"
                   alt="Capture <?= htmlspecialchars($p['title']) ?>">
            </div>
          </div>
        </div>
      </div>

      <?php else: ?>
      <!-- Visuel placeholder japonais -->
      <div class="project-visual">
        <div class="project-visual-sun"></div>
        <div class="project-visual-frame"></div>
        <div class="project-visual-kanji"><?= htmlspecialchars($d['kanji']) ?></div>
        <div class="project-visual-label">[ Capture — <?= htmlspecialchars($p['title']) ?> ]</div>
      </div>
      <?php endif; ?>

      <div>
        <div class="project-meta">
          <span class="num"><?= htmlspecialchars($d['num']) ?> / <?= $total ?></span>
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
        <a href="<?= htmlspecialchars($d['url']) ?>" target="_blank" rel="noopener" class="project-link">
          <?= htmlspecialchars($d['label']) ?>
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>
