<section id="projects">
  <div class="sh">
    <p class="sl">Réalisations</p>
    <h2 class="st">Projets récents</h2>
    <p class="ss">Des projets concrets, livrés pour de vraies personnes.</p>
  </div>
  <div class="proj-list" id="projects-list">
    <?php foreach ($projects as $p): ?>
    <div class="proj">
      <div>
        <p class="proj-type"><?= htmlspecialchars($p['type']) ?></p>
        <h3><?= htmlspecialchars($p['title']) ?></h3>
        <p class="proj-desc"><?= htmlspecialchars($p['desc']) ?></p>
        <div class="chips">
          <?php foreach ($p['chips'] as $chip): ?>
          <span class="chip">✓ <?= htmlspecialchars($chip) ?></span>
          <?php endforeach; ?>
        </div>
        <div class="techs">
          <?php foreach ($p['techs'] as $tech): ?>
          <span class="tech"><?= htmlspecialchars($tech) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <a href="<?= htmlspecialchars($p['url']) ?>" target="_blank" rel="noopener" class="proj-lnk">
        <?= htmlspecialchars($p['link_label']) ?>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
          <polyline points="15 3 21 3 21 9"/>
          <line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</section>
