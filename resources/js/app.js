/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
(async () => {
  await import(/* webpackPrefetch: true, webpackChunkName: "js/vendor/PNotify" */ 'pnotify/dist/es/PNotify.js');
  await import(/* webpackPreload: true, webpackChunkName: "js/vendor/bootstrap" */ './bootstrap');
})();


window.Vue = require('vue');

window.addEventListener('load', function () {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
}, false);

if (window.location.pathname.includes('museos')) {
  // (async () => {
  //   const PNotify = await import(/* webpackPreload: true, webpackChunkName: "js/vendor/PNotify" */ 'pnotify/dist/es/PNotify.js').then(({ default: module }) => module);
  //   PNotify.alert('Welcome to museos view');
  // })();

  PNotify.alert('Welcome to museos view');
}

