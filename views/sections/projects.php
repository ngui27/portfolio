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
$total = count($projects);
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

    <!-- Circular Carousel -->
    <div class="ct-wrap reveal">
      <div class="ct-grid">

        <!-- Images 3D -->
        <div class="ct-images" id="ct-images">
          <?php foreach ($projects as $i => $p):
            $d = $projectsDesign[$i];
          ?>
          <img
            class="ct-img"
            src="<?= htmlspecialchars($d['screen']) ?>"
            alt="<?= htmlspecialchars($p['title']) ?>"
            data-index="<?= $i ?>"
          >
          <?php endforeach; ?>
        </div>

        <!-- Contenu -->
        <div class="ct-content">
          <div class="ct-slides" id="ct-slides">
            <?php foreach ($projects as $i => $p):
              $d = $projectsDesign[$i];
            ?>
            <div class="ct-slide" data-slide="<?= $i ?>">
              <div class="ct-slide-meta">
                <span class="ct-num"><?= $d['num'] ?> / <?= $total ?></span>
                <span class="ct-year"><?= $d['year'] ?></span>
              </div>
              <h3 class="ct-title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="ct-type"><?= htmlspecialchars($d['type']) ?></p>
              <p class="ct-desc"><?= htmlspecialchars($p['desc']) ?></p>
              <div class="ct-stack">
                <?php foreach ($p['techs'] as $tech): ?>
                <span class="tag"><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
              <a href="<?= htmlspecialchars($d['url']) ?>" target="_blank" rel="noopener" class="project-link ct-link">
                <?= htmlspecialchars($d['label']) ?>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
              </a>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Navigation -->
          <div class="ct-arrows">
            <button class="ct-btn" id="ct-prev" aria-label="Projet précédent">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            </button>
            <button class="ct-btn" id="ct-next" aria-label="Projet suivant">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 19l7-7-7-7"/></svg>
            </button>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>
