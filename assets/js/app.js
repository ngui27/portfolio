// =============================================================
// ANIMATIONS D'APPARITION AU SCROLL
// Observe chaque élément animable et ajoute/retire la classe
// "revealed" quand il entre ou sort du viewport.
// =============================================================
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