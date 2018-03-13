window.fbAsyncInit = function() {
      FB.init({
      appId            : '348809548888116',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.10'
      });
      FB.AppEvents.logPageView();
  };

  (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function seConnecterFacebook(){
      // Vérifier se l'utilisateur est déjà connecté avec facebook
      FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
              // Obtenir et afficher les données à partir du profil facebook
              getFbUserData();
          }
          else{
              // Connexion
              FB.login(function (response) {
                  if (response.authResponse) {
                      // Obtenir et afficher les données à partir du profil facebook
                      getFbUserData();
                  } else {
                      // Connexion annulée par l'utilisateur
                  }
              }, {scope: 'public_profile,email'});
          }

      });
  }
  // Fetch the user profile data from facebook
  function getFbUserData(){
      FB.api('/me', {locale: 'fr_FR', fields: 'id,first_name,last_name,email'},
      function (response) {
            $.ajax({
              url: "connexion_facebook.php",
              type: "POST",
              data: 'id=' + response.id + '&email=' + response.email+ '&prenom=' + response.first_name+ '&nom=' + response.last_name,
                      beforeSend: function(){
                          $('#btn_log_fb').prop( "disabled", true ).html( "Vérification en cours...").css("color","#000");
                      }
          }).done(function( data ) {
                $('#btn_log_fb').prop( "disabled", false ).html( "<span class=\"fa fa-facebook-official\"></span> Se connecter avec facebook").css("color","#FFF");;
                if(data==""){
                    $('#alert-success').fadeIn("slow");
                    $('#btn_log_fb').prop( "disabled", false ).html( "<span class=\"glyphicon glyphicon-ok-sign\"></span> Vous etes connecté").css("color","#FFF");;

                    setTimeout(function(){ window.location = "./all-test.php"; }, 2000);

                    //$(location).attr('href',"./my-test.php");
                }
                else {
                    $('#alert-danger').html("<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> "+data);
                    $('#alert-danger').fadeIn("slow");
                }
          });
          return false;
      });
  }
  function seDeconnecter(){
      FB.logout(function(response) {
        // user is now logged out
        $('#alert-info').fadeIn("slow");
      });
  }
