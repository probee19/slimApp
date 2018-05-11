self.addEventListener('push', function(event) {
  var notificationOptions = {
    body: "Découvre à quoi tu vas ressembler quand tu auras 80 ans...",
    icon: 'https://creation.funizi.com/src/img/funizi.png',
    data:{
      url : 'https://funizi.com/test/a-quoi-ressembleras-tu-a-80-ans/319'
    }
  };
  title = "A quoi ressembleras-tu à 80 ans ?";
  return self.registration.showNotification(title, notificationOptions);
});

self.addEventListener('notificationclick', function(event) {
  var url = event.notification.data.url;
  event.notification.close();
  event.waitUntil(clients.openWindow(url));
});
