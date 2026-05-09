</div><!-- /.wrap -->
<script src="assets/js/app.js"></script>
<script>
(function () {
  var ALPHA  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzéèêëàâîïôùûü';
  var PIRATE = '☠⚓✖#@&%$!' + ALPHA;

  // Anime le texte lettre par lettre en révélant progressivement le texte final.
  // Les accents sont inclus dans ALPHA pour éviter les faux caractères en fin de mot.
  function scramble(selector, chars, duration, delay) {
    var el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    var final = el.textContent.trim();
    setTimeout(function () {
      var steps = Math.round(duration / 16);
      var step  = 0;
      var tick  = setInterval(function () {
        step++;
        var revealed = Math.floor((step / steps) * final.length);
        var text = '';
        for (var i = 0; i < final.length; i++) {
          if (final[i] === ' ') { text += ' '; continue; }
          text += i < revealed
            ? final[i]
            : chars[Math.floor(Math.random() * chars.length)];
        }
        el.textContent = text;
        if (step >= steps) {
          clearInterval(tick);
          el.textContent = final;
        }
      }, 16);
    }, delay);
  }

  // Joue l'animation une seule fois au chargement, jamais rejouée
  var hasAnimated = false;

  function runHeroAnimation() {
    if (hasAnimated) return;
    hasAnimated = true;

    var badge = document.querySelector('.hero-badge');
    if (badge) {
      badge.style.opacity    = '0';
      badge.style.transition = 'opacity 0.4s';
      requestAnimationFrame(function () { badge.style.opacity = '1'; });
    }

    scramble('#hero-l1',  ALPHA,          900,  200);
    scramble('#hero-l2',  PIRATE,         900,  600);
    scramble('#hero-l3',  ALPHA,          700, 1000);
    scramble('.hero-sub', ALPHA + ' .,', 1200, 1400);

    // Re-scramble pirate au hover — ne remet pas hasAnimated à false
    var h1   = document.querySelector('.hero-content h1');
    var busy = false;
    if (h1) {
      h1.addEventListener('mouseenter', function () {
        if (busy) return;
        busy = true;
        scramble('#hero-l1', PIRATE, 600,   0);
        scramble('#hero-l2', PIRATE, 600, 100);
        scramble('#hero-l3', PIRATE, 600, 200);
        setTimeout(function () { busy = false; }, 900);
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', runHeroAnimation, { once: true });
  } else {
    runHeroAnimation();
  }
})();
</script>
</body>
</html>
