function statusChangeCallback(response, id) {
  console.log("statusChangeCallback");
  console.log(response);
  var currentUrl = "http://funizi.com";

  // The response object is returned with a status field that lets the
  // app know the current login status of the person.
  // Full docs on the response object can be found in the documentation
  // for FB.getLoginStatus().
  if (response.status === "connected") {
    // Logged into your app and Facebook redirect to the redirectional url
    window.location.replace(currentUrl + "/start?ref=" + id);
  } else if (response.status === "not_authorized") {
    FB.login(function(response) {
      if (response.authResponse) {
        //alert('You are logged in &amp; cookie set!');
        window.location.replace(currentUrl + "/start?ref=" + id);
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
        console.log("test parti");
      } else {
        //alert('User cancelled login or did not fully authorize.');
        //$('#myModal').modal();
      }
    });
  } else {
    // The person is not logged into Facebook, so we're not sure if
    // they are logged into this app or not.
    FB.login(function(response) {
      if (response.authResponse) {
        //alert('You are logged in &amp; cookie set!');
        window.location.replace("http://funizi.com/start?ref=" + id);
        console.log("test parti");
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        //alert('Veuillez accepter l\'inscription à votre compte Facebook pour participer au jeu');
        //$("#myModal").modal();
      }
    });
  }
}
function checkLoginState(id) {
  console.log('hello');
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response, id);
  });
}
logInWithFacebook = function(id) {
  FB.login(
    function(response) {
      if (response.authResponse) {
        loader();
        //console.log(response.authResponse);
        //alert('You are logged in &amp; cookie set!');
        window.location.replace("http://funizi.com/start?ref=" + id);
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        //alert('User cancelled login or did not fully authorize.');
        console.log("denied");
        notLoader();
      }
    },
    { scope: "public_profile" }
  );
  return false;
};

window.fbAsyncInit = function() {
  FB.init({
    appId: "348809548888116",
    cookie: true, // enable cookies to allow the server to access the session
    autoLogAppEvents: true,
    xfbml: true, // parse social plugins on this page
    version: "v2.5" // use any version
  });

};

// Load the SDK asynchronously
(function(d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s);
  js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
})(document, "script", "facebook-jssdk");

loader = function() {
    $("#btn-result").prop('disabled', true);
    $("#btn-result").html("Connexion en cours...");
    $("#div_test").fadeOut("fast");
    $("#div_loader").fadeIn("fast");
};

notLoader = function() {
  $("#btn-result").html(
    '<i class="fa fa-facebook-square"></i>  Connecte-toi sur Facebook'
  );
  $("#div_test").fadeIn("fast");
  $("#div_loader").fadeOut("fast");
};
