window.fbAsyncInit = function() {
    FB.init({
        appId            : "<?php echo $_SESSION['fb_access_token]; ?>",
        autoLogAppEvents : true,
        xfbml            : true,
        version          : 'v2.12',
        status           : true,
        cookie           : true,
        oauth            : true
    });
    FB.AppEvents.logPageView();

};
/**
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/

var domain = $("#domain").data("domain");

function seConnecterFacebook(id, requestType) {
    var scopeList = 'public_profile';
    if(requestType === 1) scopeList = 'public_profile, user_friends, user_posts, user_photos';
    FB.login(function(response) {
        if (response.authResponse) {
            // Obtenir et afficher les données à partir du profil facebook
            getFbUserData(id, requestType);
        } else {
            //alert('User cancelled login or did not fully authorize.');
            console.log('denied');
        }
    },{scope: scopeList, auth_type: 'rerequest'});
};
// Fetch the user profile data from facebook
function getFbUserData(id, requestType){
    if(requestType === 1)
    {
        FB.api('/me/permissions ',
        function (permissions) {
            //$.each(permissions.data, function (key, value) {
                //if( value['status']==='declined'){ permissionsOk = false; console.log( value['permission']+' declined '+permissionsOk);}})
            var permissionsOk = true, otherData ='';
            for (i = 0; i < permissions.data.length; i++) {
                if ((permissions.data[i].permission === 'user_friends' || permissions.data[i].permission === 'user_photos' || permissions.data[i].permission === 'user_posts') && permissions.data[i].status === 'declined') {
                  permissionsOk = false;
                }
            }

            if(!permissionsOk){
                $('.modal-body').html(
                    " <p>Veuillez vous connecter via Facebook pour créer votre propre test !<br>Simple ! Gratuit ! Sécurisé !</p>"+
                    "<p style='font-weight:700'> Les autorisations suivantes sont nécessaires pour effectuer  ce test : <br> Liste d'amis, Publications, Photos </p>"+
                    "<p style='font-weight:800'> Vous devez accorder les autorisations pour continuer.");
                $('#div_erreur_aut').fadeIn('slow').css('display','block');
                setTimeout(function(){ $('#div_erreur_aut').fadeOut()}, 7000);

            }
            else {

                $('.modal-body').html(" <p>Veuillez vous connecter via Facebook pour créer votre propre test !<br>Simple ! Gratuit ! Sécurisé !</p>");
                // User Fiends
                FB.api('/me/friends', {locale: 'fr_FR', fields: 'id,first_name,last_name,gender'},
                function (friends) {
                    var json_friends = JSON.stringify(friends.data);
                    otherData += '&friends=' + json_friends;
                    // User Posts
                    FB.api('/me/posts', {locale: 'fr_FR', fields: 'reactions{id,name}'},
                    function (posts) {
                        var json_posts = JSON.stringify(posts.data);
                        otherData += '&posts=' + json_posts;
                        // User Photos
                        FB.api('/me/photos', {locale: 'fr_FR', fields: 'from{id,name}'},
                        function (photos) {
                            var json_photos = JSON.stringify(photos.data);
                            otherData += '&photos=' + json_photos;
                            console.log(otherData);

                            FB.api('/me', {locale: 'fr_FR', fields: 'id,first_name,last_name,gender'},
                                function (response) {
                                    $.ajax({
                                        url: domain+"/connect_user",
                                        type: "POST",
                                        data: 'id=' + response.id + '&prenom=' + response.first_name+ '&nom=' + response.last_name+ '&genre=' + response.gender + otherData,
                                        beforeSend: function(){
                                            loader();
                                        }
                                    }).done(function( data ) {
                                      console.log(data);
                                        console.log(data);

                                        if(data !== ''){
                                            window.location.replace(domain+"/start/" + id);
                                        }
                                    });
                                    return false;
                            });
                        });
                    });
                });
            }
        });
    }
    else{
        console.log(requestType);
        FB.api('/me', {locale: 'fr_FR', fields: 'id,first_name,last_name,gender'},
            function (response) {
                $.ajax({
                    url: domain+"/connect_user",
                    type: "POST",
                    data: 'id=' + response.id + '&prenom=' + response.first_name+ '&nom=' + response.last_name+ '&genre=' + response.gender,
                    beforeSend: function(){
                        //loader();
                    }
                }).done(function( data ) {
                    console.log(data);

                    if(data !== ''){
                        window.location.replace(domain+"/start/" + id);
                    }
                });
                return false;
        });
    }
}

//var tasks = Array('Vérification en cours...','Analyse du profil...','Consultation de la liste des amis...','Calcul du résultat...');
var task = 0;
loader = function() {
  //$("#btn-result").html("Connexion en cours...");
  $("#btn-result").prop('disabled', true);
  $("#div_test").css("display","none");
  $("#div_loader").css("display","block");
  setInterval(function () {
      //$("#div_tasks").html(tasks[Math.floor(Math.random() * tasks.length)]);
      if( task >= tasks.length){
          task = 0;
      }
      $("#div_tasks").html(tasks[task++]);
  },700);

  //confirmOptIn();

};

loaderReTest = function () {
      $("#result_block").css("display","none");
      $("#div_loader").css("display","block");
      $("html, body").animate({ scrollTop: 0 }, 600);
      setInterval(function () {
          //$("#div_tasks").html(tasks[Math.floor(Math.random() * tasks.length)]);
          if( task >= tasks.length){
              task = 0;
          }
          $("#div_tasks").html(tasks[task++]);
      },700);

}

notLoader = function() {
  $("#btn-result").html(
    '<i class="fa fa-facebook-square"></i>  Connecte-toi sur Facebook'
  );
  $("#div_test").fadeIn("fast");
  $("#div_loader").fadeOut("fast");
};
