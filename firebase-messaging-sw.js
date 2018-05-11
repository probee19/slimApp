
self.addEventListener('push', function(event) {
  event.waitUntil(
    self.registration.pushManager.getSubscription()
    .then(function(subscription) {
      fetch("https://fr.funizi.com/get-notification")
      .then(function(response) {
        console.log(response);
        if (response.status !== 200) {
          // gestion des code d'erreurs HTTP
        }
        return response.json();
      })
      .then(function(data) {
        // obtenir de data les informations de la notification pour l'afficher
        var notificationOptions = {
          body: data.body,
          icon: data.icon ? data.icon : 'https://funizi.com/creation-test/src/img/funizi.png',
          data:{
            url : data.clickUrl
          }
        };
        title = data.title;
        return self.registration.showNotification(title, notificationOptions);
      })
      .catch(function(err) {
        // gestion des erreurs
      })
    })
    .catch(function(err) {
      //gestion de l'erreur de récupération de l'inscription
    })
  );
});




self.addEventListener('notificationclick', function(event) {
  var url = event.notification.data.url;
  event.notification.close();
  event.waitUntil(clients.openWindow(url));
});
