// ---------- Lenis smooth scroll ----------
(function () {
  if (typeof Lenis === 'undefined') return;
  var lenis = new Lenis({
    duration: 1.25,
    easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
    smoothWheel: true,
    smoothTouch: false,
  });
  window.__lenis = lenis;

  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }
  requestAnimationFrame(raf);

  // Lenis + ancres : smooth scroll vers les sections
  document.querySelectorAll('a[href^="#"], a[href^="/#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var hash = a.getAttribute('href').replace(/^\//, '');
      var target = document.querySelector(hash);
      if (!target) return;
      e.preventDefault();
      lenis.scrollTo(target, { offset: -80, duration: 1.4 });
    });
  });
})();

// ---------- Theme (dark / light) ----------
(function () {
  var html = document.documentElement;
  var stored = 'light';
  try { stored = localStorage.getItem('yelidev-theme') || 'light'; } catch(e){}
  html.dataset.theme = stored;

  window.__toggleTheme = function () {
    var next = html.dataset.theme === 'dark' ? 'light' : 'dark';
    html.dataset.theme = next;
    try { localStorage.setItem('yelidev-theme', next); } catch(e){}
    // update icon
    var sun = document.getElementById('icon-sun');
    var moon = document.getElementById('icon-moon');
    if (sun) sun.style.display = next === 'dark' ? '' : 'none';
    if (moon) moon.style.display = next === 'light' ? '' : 'none';
  };
})();

document.addEventListener('DOMContentLoaded', function () {
  var html = document.documentElement;

  // ---------- Sync theme toggle icon ----------
  var sun = document.getElementById('icon-sun');
  var moon = document.getElementById('icon-moon');
  if (sun && moon) {
    sun.style.display = html.dataset.theme === 'dark' ? '' : 'none';
    moon.style.display = html.dataset.theme === 'light' ? '' : 'none';
  }

  // ---------- ContainerScroll 3D ----------
  var csContainers = document.querySelectorAll('[data-cs]');
  if (csContainers.length) {
    var isMobile = window.innerWidth <= 768;
    window.addEventListener('resize', function () { isMobile = window.innerWidth <= 768; });

    var animateCS = function () {
      csContainers.forEach(function (container) {
        var card = container.querySelector('.cs-card');
        if (!card) return;
        var rect = container.getBoundingClientRect();
        var vh = window.innerHeight;

        // progress 0 (carte en haut du viewport) → 1 (carte en bas)
        var progress = 1 - Math.max(0, Math.min(1, rect.top / vh));

        // rotateX : 20deg → 0deg
        var rotateX = 20 * (1 - progress);
        // scale : 1.05 → 1  (mobile : 0.7 → 0.9)
        var scaleMin = isMobile ? 0.7 : 1.05;
        var scaleMax = isMobile ? 0.9 : 1.0;
        var scale = scaleMin + (scaleMax - scaleMin) * progress;

        card.style.transform = 'rotateX(' + rotateX + 'deg) scale(' + scale + ')';
      });
    };

    window.addEventListener('scroll', animateCS, { passive: true });
    animateCS();
  }

  // ---------- Nav pill (sliding cursor) ----------
  var pillWrap = document.getElementById('nav-pill-wrap');
  var pill = document.getElementById('nav-pill');
  if (pillWrap && pill) {
    var navItems = pillWrap.querySelectorAll('li');
    navItems.forEach(function (li) {
      li.addEventListener('mouseenter', function () {
        pill.style.left  = li.offsetLeft + 'px';
        pill.style.width = li.offsetWidth + 'px';
        pill.style.opacity = '1';
      });
    });
    pillWrap.addEventListener('mouseleave', function () {
      pill.style.opacity = '0';
    });
  }

  // ---------- Nav scroll ----------
  var nav = document.querySelector('.nav');
  if (nav) {
    var onScroll = function () {
      nav.classList.toggle('scrolled', window.scrollY > 24);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ---------- Mobile menu ----------
  var mobileToggle = document.querySelector('.mobile-toggle');
  var mobileMenu = document.querySelector('.mobile-menu');
  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', function () {
      mobileMenu.classList.toggle('open');
    });
    mobileMenu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        mobileMenu.classList.remove('open');
      });
    });
  }

  // ---------- Scroll reveal ----------
  var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!prefersReduced) {
    html.classList.add('js-reveal');

    var markInView = function () {
      document.querySelectorAll('.reveal:not(.in)').forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.top < window.innerHeight - 20 && r.bottom > 0) {
          el.classList.add('in');
        }
      });
    };

    requestAnimationFrame(function () {
      requestAnimationFrame(markInView);
    });

    try {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            e.target.classList.add('in');
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
      document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
    } catch(e) {}

    window.addEventListener('scroll', markInView, { passive: true });
    window.addEventListener('resize', markInView);
    setTimeout(markInView, 200);
    setTimeout(function () {
      document.querySelectorAll('.reveal:not(.in)').forEach(function (el) {
        el.classList.add('in');
      });
    }, 2000);
  }

  // ---------- Journal Carousel ----------
  var jcTrack  = document.getElementById('jc-track');
  var jcPrev   = document.getElementById('jc-prev');
  var jcNext   = document.getElementById('jc-next');
  var jcOverlay = document.getElementById('jc-overlay');
  var jcClose  = document.getElementById('jc-overlay-close');

  if (jcTrack && jcPrev && jcNext) {
    var SCROLL_AMOUNT = 404;

    var updateArrows = function () {
      jcPrev.disabled = jcTrack.scrollLeft <= 0;
      jcNext.disabled = jcTrack.scrollLeft >= jcTrack.scrollWidth - jcTrack.clientWidth - 1;
    };
    updateArrows();
    jcTrack.addEventListener('scroll', updateArrows, { passive: true });

    jcPrev.addEventListener('click', function () {
      jcTrack.scrollBy({ left: -SCROLL_AMOUNT, behavior: 'smooth' });
    });
    jcNext.addEventListener('click', function () {
      jcTrack.scrollBy({ left: SCROLL_AMOUNT, behavior: 'smooth' });
    });

    // Cartes cliquables → overlay
    jcTrack.querySelectorAll('.jc-card').forEach(function (card) {
      card.addEventListener('click', function () {
        var d = card.dataset;
        document.getElementById('jc-overlay-cat').textContent    = d.cat;
        document.getElementById('jc-overlay-date').textContent   = d.date + ' · ' + d.read + ' min';
        document.getElementById('jc-overlay-excerpt').textContent = d.excerpt;
        document.getElementById('jc-overlay-title').textContent  = d.title;
        var link = document.getElementById('jc-overlay-link');
        link.href = '/blog/' + d.slug;

        // Fond image dans l'overlay
        var bg = document.getElementById('jc-overlay-bg');
        bg.style.cssText = 'background-image:url(' + d.img + ');background-size:cover;background-position:center;opacity:0.08;';

        jcOverlay.classList.add('open');
        jcOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
      });
    });

    // Fermer l'overlay
    var closeOverlay = function () {
      jcOverlay.classList.remove('open');
      jcOverlay.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    };

    if (jcClose) jcClose.addEventListener('click', closeOverlay);
    jcOverlay.addEventListener('click', function (e) {
      if (e.target === jcOverlay) closeOverlay();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && jcOverlay.classList.contains('open')) closeOverlay();
    });
  }

  // ---------- Contact form ----------
  var form = document.getElementById('contact-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = form.querySelector('[type=submit]');
      var msg = document.getElementById('ct-msg');
      btn.disabled = true;
      var origText = btn.textContent;
      btn.textContent = 'Envoi…';
      fetch('/', { method: 'POST', body: new FormData(form) })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (msg) {
            msg.textContent = data.message;
            msg.className = 'ct-feedback ' + (data.success ? 'ok' : 'err');
          }
          if (data.success) form.reset();
        })
        .catch(function () {
          if (msg) {
            msg.textContent = 'Erreur réseau. Réessayez.';
            msg.className = 'ct-feedback err';
          }
        })
        .finally(function () {
          btn.disabled = false;
          btn.textContent = origText;
        });
    });
  }

  // ---------- Lightbox ----------
  var overlay = document.getElementById('lb-overlay');
  var lbImg = document.getElementById('lb-img');
  var lbClose = document.getElementById('lb-close');
  if (overlay) {
    document.querySelectorAll('.article-img img').forEach(function (img) {
      img.addEventListener('click', function () {
        lbImg.src = img.src;
        lbImg.alt = img.alt || '';
        overlay.classList.add('lb-open');
        document.body.style.overflow = 'hidden';
      });
    });
    if (lbClose) {
      lbClose.addEventListener('click', closeLb);
    }
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeLb();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeLb();
    });
    function closeLb() {
      overlay.classList.remove('lb-open');
      document.body.style.overflow = '';
      lbImg.src = '';
    }
  }
});
