<?php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section id="contact" class="section">
  <div class="bg-kanji" style="right:-6vw;bottom:-6vh">話</div>
  <div class="container">
    <div class="contact-grid">
      <div class="contact-info reveal">
        <div class="section-eyebrow">Contact <span class="kanji">連絡</span></div>
        <h2 class="section-title">
          Parlons de votre projet,<br>autour d'un <em style="color:var(--vermillion);font-style:italic">café</em> si vous voulez.
        </h2>
        <p style="color:var(--muted);font-size:17px;line-height:1.6;margin-bottom:48px;max-width:460px">
          Réponse sous 24h en semaine. Premier échange gratuit, sans
          engagement. Devis détaillé sous 48h après notre appel.
        </p>

        <div class="contact-block">
          <div class="label">Courriel direct</div>
          <div class="value"><a href="mailto:ngui@yelidev.ca">ngui@yelidev.ca</a></div>
        </div>
        <div class="contact-block">
          <div class="label">Sur le web</div>
          <div class="socials">
            <a href="https://github.com/ngui27/" class="social" target="_blank" rel="noopener" aria-label="GitHub">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5a12 12 0 0 0-3.8 23.4c.6.1.8-.3.8-.6v-2c-3.3.7-4-1.6-4-1.6-.6-1.4-1.4-1.8-1.4-1.8-1.1-.8.1-.8.1-.8 1.3.1 2 1.3 2 1.3 1.1 1.9 3 1.4 3.7 1 .1-.8.4-1.4.8-1.7-2.7-.3-5.5-1.3-5.5-6 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.5.1-3.2 0 0 1-.3 3.3 1.2a11.5 11.5 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.7.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.5 6 .4.4.8 1.1.8 2.3v3.4c0 .3.2.7.8.6A12 12 0 0 0 12 .5z"/></svg>
            </a>
            <a href="#" class="social" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.5 2h-17A1.5 1.5 0 0 0 2 3.5v17A1.5 1.5 0 0 0 3.5 22h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 20.5 2zM8 19H5V8h3v11zM6.5 6.7a1.75 1.75 0 1 1 0-3.5 1.75 1.75 0 0 1 0 3.5zM19 19h-3v-5.6c0-1.4-.5-2.4-1.7-2.4a1.85 1.85 0 0 0-1.7 1.2 2.4 2.4 0 0 0-.1.8V19h-3V8h3v1.3A3 3 0 0 1 15.2 8c2 0 3.5 1.3 3.5 4.1V19z"/></svg>
            </a>
            <a href="mailto:ngui@yelidev.ca" class="social" aria-label="Courriel">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
            </a>
          </div>
        </div>
      </div>

      <form class="form reveal" data-delay="2" id="contact-form" method="post" action="/" novalidate>
        <input type="hidden" name="action" value="contact">
        <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">
        <div class="ct-honeypot" aria-hidden="true">
          <label for="ct-website">Ne pas remplir</label>
          <input type="text" id="ct-website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <div class="form-field">
          <label for="ct-name">01 · Votre nom</label>
          <input id="ct-name" type="text" name="name" placeholder="Marie Tremblay" maxlength="100" required>
        </div>
        <div class="form-field">
          <label for="ct-email">02 · Votre courriel</label>
          <input id="ct-email" type="email" name="email" placeholder="marie@entreprise.ca" maxlength="150" required>
        </div>
        <div class="form-field">
          <label for="ct-message">03 · Votre projet</label>
          <textarea id="ct-message" name="message" rows="5" placeholder="J'ai une PME à Montréal et j'aimerais refaire mon site…" maxlength="2000" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px">
          Envoyer le message <span class="arrow">→</span>
        </button>
        <p id="ct-msg" class="ct-feedback" aria-live="polite"></p>
      </form>
    </div>
  </div>
</section>
