</div><!-- /.wrap -->
<script src="/assets/js/app.js"></script>
<script>
(function () {
  var form = document.getElementById('contact-form');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var btn = form.querySelector('[type=submit]');
    var msg = document.getElementById('ct-msg');
    btn.disabled    = true;
    btn.textContent = 'Envoi…';
    fetch('/', { method: 'POST', body: new FormData(form) })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        msg.textContent = data.message;
        msg.className   = 'ct-feedback ' + (data.success ? 'ok' : 'err');
        if (data.success) form.reset();
      })
      .catch(function () {
        msg.textContent = 'Erreur réseau. Réessayez.';
        msg.className   = 'ct-feedback err';
      })
      .finally(function () {
        btn.disabled    = false;
        btn.textContent = 'Envoyer le message';
      });
  });
})();
</script>
</body>
</html>
