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
