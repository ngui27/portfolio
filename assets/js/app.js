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


// =============================================================
// CONSTANTES DU VINYLE
// =============================================================
const DURATION       = 300;   // durée totale de lecture en secondes (5 min)
const CX_READ        = 210;   // centre X du canvas d'arc (px)
const CY_READ        = 210;   // centre Y du canvas d'arc (px)
const SILLON_R_OUTER = 185;   // rayon du sillon extérieur (début de lecture)
const SILLON_R_INNER = 58;    // rayon du sillon intérieur (fin de lecture)
const DOT_R          = 6;     // rayon du point blanc (tête de lecture)
const NEEDLE_CX      = 200;   // centre X du canvas tête de lecture
const NEEDLE_CY      = 200;   // centre Y du canvas tête de lecture
const SPIN_SPD       = 360 / 4; // vitesse de rotation du disque (degrés/seconde)
const NEEDLE_ANGLE   = -30;     // position fixe de l'aiguille : 14h (60° depuis 12h)

// État de la lecture
let elapsed     = 0;    // temps écoulé en secondes
let playing     = true; // true = en cours de lecture
let lastTime    = null; // timestamp du dernier frame (pour calculer dt)
let spinDeg     = 0;    // angle de rotation actuel du disque (degrés)
let prevSpinDeg = 0;    // angle au frame précédent (pour calculer l'arc ajouté)
let raf         = null; // identifiant requestAnimationFrame en cours

// Références aux éléments DOM du vinyle
const canvasRead   = document.getElementById('canvas-read');
const ctxRead      = canvasRead.getContext('2d');
const canvasNeedle = document.getElementById('canvas-needle');
const ctxNeedle    = canvasNeedle.getContext('2d');
const disk         = document.getElementById('disk');
const prog         = document.getElementById('prog');
const timerEl      = document.getElementById('timer');
const btn          = document.getElementById('btn');

// Désactive l'animation CSS du disque — la rotation est gérée en JS
disk.style.animation = 'none';

// -------------------------------------------------------------
// Dessine la tête de lecture (point blanc) — FIXE à 12h.
// Seul le rayon varie (de SILLON_R_OUTER à SILLON_R_INNER)
// pour simuler la progression du bras vers le centre.
// canvas-needle ne tourne pas.
// -------------------------------------------------------------
function drawNeedle(fraction) {
  ctxNeedle.clearRect(0, 0, 400, 400);
  var r     = SILLON_R_OUTER - fraction * (SILLON_R_OUTER - SILLON_R_INNER);
  var angle = NEEDLE_ANGLE * Math.PI / 180;
  var nx    = NEEDLE_CX + r * Math.cos(angle);
  var ny    = NEEDLE_CY + r * Math.sin(angle);
  ctxNeedle.beginPath();
  ctxNeedle.arc(nx, ny, DOT_R + 4, 0, Math.PI * 2);
  ctxNeedle.fillStyle = 'rgba(255,255,255,0.12)';
  ctxNeedle.fill();
  ctxNeedle.beginPath();
  ctxNeedle.arc(nx, ny, DOT_R, 0, Math.PI * 2);
  ctxNeedle.fillStyle = '#ffffff';
  ctxNeedle.fill();
}

// -------------------------------------------------------------
// Trace le sillon lu sur canvas-read, qui tourne avec le disque.
// À chaque frame on ajoute un petit arc en coordonnées LOCALES
// du disque : l'aiguille (fixe à 12h dans le monde) se déplace
// de -prevSpinDeg° à -spinDeg° dans le repère du disque.
// Comme canvas-read tourne avec le disque, l'arc paraît ancré
// sur le vinyle et tourne avec lui — effet "sillon qui rougit".
// -------------------------------------------------------------
function drawTrail(fraction, spinDeg, prevSpinDeg) {
  var r         = SILLON_R_OUTER - fraction * (SILLON_R_OUTER - SILLON_R_INNER);
  var prevAngle = (NEEDLE_ANGLE - prevSpinDeg) * Math.PI / 180;
  var currAngle = (NEEDLE_ANGLE - spinDeg)     * Math.PI / 180;
  ctxRead.beginPath();
  ctxRead.arc(CX_READ, CY_READ, r, prevAngle, currAngle, true);
  ctxRead.strokeStyle = '#f30014';
  ctxRead.lineWidth   = 0.3;
  ctxRead.lineCap     = 'round';
  ctxRead.stroke();
}

// -------------------------------------------------------------
// Formate un nombre de secondes en chaîne "m:ss".
// Exemple : 65 → "1:05"
// -------------------------------------------------------------
function fmtTime(t) {
  var m = Math.floor(t / 60);
  var s = Math.floor(t % 60);
  return m + ':' + (s < 10 ? '0' : '') + s;
}

// -------------------------------------------------------------
// Boucle d'animation principale (appelée par requestAnimationFrame).
// Calcule le delta-temps entre chaque frame, fait avancer elapsed
// et spinDeg, puis met à jour le disque, la tête, l'arc et le timer.
// Arrête la boucle et affiche "Recommencer" quand la durée est atteinte.
// -------------------------------------------------------------
function loop(ts) {
  if (lastTime === null) lastTime = ts;
  var dt = (ts - lastTime) / 1000; // delta en secondes
  lastTime = ts;
  if (playing) {
    elapsed = Math.min(elapsed + dt, DURATION);
    spinDeg = spinDeg + SPIN_SPD * dt;
    var fraction = elapsed / DURATION;
    disk.style.transform        = 'rotate(' + spinDeg + 'deg)';
    canvasRead.style.transform  = 'rotate(' + spinDeg + 'deg)';
    drawNeedle(fraction);
    drawTrail(fraction, spinDeg, prevSpinDeg);
    prevSpinDeg = spinDeg;
    prog.style.width    = (fraction * 100) + '%';
    timerEl.textContent = fmtTime(elapsed) + ' / 5:00';
  }
  if (elapsed < DURATION) {
    raf = requestAnimationFrame(loop);
  } else {
    btn.textContent = 'Recommencer';
    playing = false;
  }
}

// Dessin initial (position 0) puis lancement de la boucle
drawNeedle(0);
raf = requestAnimationFrame(loop);

// -------------------------------------------------------------
// Gestion du bouton Pause / Play / Recommencer.
// - Si la lecture est terminée : remet tout à zéro et repart.
// - Sinon : bascule entre pause et lecture.
// -------------------------------------------------------------
btn.addEventListener('click', function() {
  if (elapsed >= DURATION) {
    elapsed = 0; spinDeg = 0; prevSpinDeg = 0; playing = true; lastTime = null;
    ctxRead.clearRect(0, 0, 420, 420);
    canvasRead.style.transform = 'rotate(0deg)';
    prog.style.width    = '0%';
    timerEl.textContent = '0:00 / 5:00';
    btn.textContent     = 'Pause';
    raf = requestAnimationFrame(loop);
    return;
  }
  playing = !playing;
  btn.textContent = playing ? 'Pause' : 'Play';
  if (playing) { lastTime = null; raf = requestAnimationFrame(loop); }
});
