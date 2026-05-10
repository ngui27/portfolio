<?php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section id="contact">
  <div class="ct-box">
    <p class="sl" style="text-align:center">Contact</p>
    <h2 class="st">Vous avez un projet ?<br>Parlons-en.</h2>
    <p class="ss">Je réponds à tous les messages sous 24h. Même si c'est encore flou.</p>

    <form id="contact-form" method="post" action="/" novalidate>
      <input type="hidden" name="action" value="contact">
      <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">

      <!-- Honeypot : invisible pour les humains, rempli par les bots -->
      <div class="ct-honeypot" aria-hidden="true">
        <label for="ct-website">Ne pas remplir</label>
        <input type="text" id="ct-website" name="website" tabindex="-1" autocomplete="off">
      </div>

      <div class="ct-field">
        <label for="ct-name">Votre nom</label>
        <input type="text" id="ct-name" name="name" class="ct-input" placeholder="Marie Tremblay" maxlength="100" required>
      </div>
      <div class="ct-field">
        <label for="ct-email">Votre email</label>
        <input type="email" id="ct-email" name="email" class="ct-input" placeholder="marie@exemple.com" maxlength="150" required>
      </div>
      <div class="ct-field">
        <label for="ct-message">Votre message</label>
        <textarea id="ct-message" name="message" class="ct-textarea" placeholder="Décrivez votre projet..." maxlength="2000" required></textarea>
      </div>
      <button type="submit" class="ct-submit">Envoyer le message</button>
      <p id="ct-msg" class="ct-feedback" aria-live="polite"></p>
    </form>

    <div class="ct-or">ou</div>
    <a href="mailto:ngui27@gmail.com" class="ct-email">ngui27@gmail.com</a>
    <div class="socials">
      <a href="#" class="soc">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
        GitHub
      </a>
      <a href="#" class="soc">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
        LinkedIn
      </a>
    </div>
  </div>
</section>
