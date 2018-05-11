var domain = $("#domain").data("domain");
function registerServiceWorker () {
  if ('serviceWorker' in navigator) {
    // enregistrement du fichier 'service-worker.js' présent à la racine de l'application
    navigator.serviceWorker.register('{{ base_url() }}/src/js/service-worker.js').then(function (reg) {
      // registration worked
      console.log('Registration succeeded. Scope is ' + reg.scope);
      subscribeDevice();
    }).catch(function (error) {
      // registration failed
      console.log('Registration failed with ' + error);
    });
  }
}


function subscribeDevice () {
  navigator.serviceWorker.ready.then(function (serviceWorkerRegistration) {
    // Demande d'inscription au Push Server (1)
    return serviceWorkerRegistration.pushManager.subscribe({ userVisibleOnly: true });
  }).then(function (subscription) {
    //sauvegarde de l'inscription dans le serveur applicatif (2)
    fetch(domain + '/register-to-notification', {
      method: 'post',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      credentials: 'same-origin',
      body: JSON.stringify(subscription)
    }).then(function (response) {
      return response.json();
    }).catch(function (err) {
      console.log('Could not register subscription into app server', err);
    });
  }).catch(function (subscriptionErr) {
    // Check for a permission prompt issue
    console.log('Subscription failed ' + subscriptionErr);
  });
}
