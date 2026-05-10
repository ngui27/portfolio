// =============================================================
// ANIMATIONS D'APPARITION AU SCROLL
// Observe chaque élément animable et ajoute/retire la classe
// "revealed" quand il entre ou sort du viewport.
// =============================================================
// =============================================================
// YEUX DU CHAT — suivent le curseur de la souris
// =============================================================
(function () {
  function initCatEyes() {
    const eyes = [
      { eye: document.querySelector('.eye--left'),  pupil: document.querySelector('.eye--left .eye-pupil') },
      { eye: document.querySelector('.eye--right'), pupil: document.querySelector('.eye--right .eye-pupil') },
    ];

    if (!eyes[0].eye) return;

    document.addEventListener('mousemove', (e) => {
      eyes.forEach(({ eye, pupil }) => {
        const rect = eye.getBoundingClientRect();
        const cx = rect.left + rect.width / 2;
        const cy = rect.top + rect.height / 2;

        const dx = e.clientX - cx;
        const dy = e.clientY - cy;
        const angle = Math.atan2(dy, dx);
        const dist  = Math.sqrt(dx * dx + dy * dy);
        const scale = Math.min(dist, 150) / 150;

        const moveX = Math.cos(angle) * rect.width  * 0.28 * scale;
        const moveY = Math.sin(angle) * rect.height * 0.22 * scale;

        pupil.style.transform = `translate(${moveX}px, ${moveY}px)`;
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCatEyes);
  } else {
    initCatEyes();
  }
})();

document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            entry.target.classList.toggle('revealed', entry.isIntersecting);
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    // Définit un délai CSS progressif selon la position de l'élément
    // parmi ses frères, puis lance l'observation.
    document.querySelectorAll('.sh, .svc, .proj, .why-i, .ct-box').forEach(el => {
        const idx = [...el.parentElement.children].indexOf(el);
        el.style.setProperty('--d', `${idx * 0.1}s`);
        el.classList.add('reveal');
        observer.observe(el);
    });
});