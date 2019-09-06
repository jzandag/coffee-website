/*if (!('serviceWorker' in navigator)) {
// Service Worker isn't supported on this browser, disable or hide UI.
 console.log('not supported');
}

if (!('PushManager' in window)) {
// Push isn't supported on this browser, disable or hide UI.
console.log('not supported');
}*/

registerServiceWorker();

function registerServiceWorker() {
  return navigator.serviceWorker.register('js/dashboard.js')
  .then(function(registration) {
    console.log('Service worker successfully registered.');
    return registration;
  })
  .catch(function(err) {
    console.error('Unable to register service worker.', err);
  });
}