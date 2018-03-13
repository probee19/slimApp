$(document).ready(function () {
    $("#btn-result").removeClass("disabled");
    var id ='';
    var domain = $("#domain").data("domain");

    window.fbAsyncInit = function() {
        FB.init({
            appId: "<?php echo $_SESSION['fb_access_token]; ?>",
            cookie: true, // enable cookies to allow the server to access the session
            autoLogAppEvents: true,
            xfbml: true, // parse social plugins on this page
            version: "v2.12" // use any version
        });

        /**
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
            */

        FB.Event.subscribe('messenger_checkbox', function(e) {
             console.log("messenger_checkbox event");
             console.log(e);

             if (e.event == 'rendered') {
               console.log("Plugin was rendered");
             } else if (e.event == 'checkbox') {
               var checkboxState = e.state;
               console.log("Checkbox state: " + checkboxState);
             } else if (e.event == 'not_you') {
               console.log("User clicked 'not you'");
             } else if (e.event == 'hidden') {
               console.log("Plugin was hidden");
             }

           });


        FB.getLoginStatus(function(response) {
            if (response.status === "connected") {
                // Logged into your app and Facebook redirect to the redirectional url
                console.log('is_connected');
                FB.api('/me', {locale: 'fr_FR', fields: 'id,first_name,last_name,link,gender,locale'},
                    function (response) {
                        $.ajax({
                            url: domain+"/setsession",
                            type: "POST",
                            data: 'id=' + response.id + '&first_name=' + response.first_name + '&last_name=' + response.last_name + '&gender=' + response.gender,
                            beforeSend: function(){
                              console.log('sending...');
                                //$('#btn_log_fb').prop( "disabled", true ).html( "Connexion en cours...").css("color","#000");
                                $("#btn-result").addClass("disabled");
                            }
                        }).done(function( data ) {
                            console.log(data);
                            $("#btn-result").removeClass("disabled");
                              //$("#btn_result").prop( "disabled", false );
                        });
                    });
            }else{
                console.log('not_connected');
            }
        });
    };

    openModalDiscovery();


    $(".btn_to_track").on("click", function () {
        //clickButton($(this).attr("data-btn"));
    });

    $("#btn-result").on("click", function (e) {
        $(this).removeClass("disabled");
        console.log('Test en cours');
    });


});

function changeLang(lang) {
  var uri = $('#domain').data('resquest-uri');
  if (uri.indexOf('?') >= 0)
    window.location.replace('https://'+lang+'.funizi.com'+uri+'&utm_source=funizi&utm_medium=select&utm_campaign=select_lang');
  else
    window.location.replace('https://'+lang+'.funizi.com'+uri+'?utm_source=funizi&utm_medium=select&utm_campaign=select_lang');

}


function partage(id, lang, btn){
            $.ajax({
                url: domain+'/share/'+btn+'/'+lang,
                type: 'post',
                data: {'code': id},
                success:function(data){
                    console.log(data);
                },
                error:function(response){
                    console.log(response);
                }
            });
}

function openModal(id){
    var mymodal = $('#facebook-login-modal');
    $('#btn_log_fb').attr('onClick', 'seConnecterFacebook('+id+', '+ 0 + ')');
    mymodal.modal('show');
}

function openModalDiscovery(){
    //var mymodal = $('#discovery-tests-modal');
    if($('#discovery-tests-modal').length > 0)
        $('#discovery-tests-modal').modal('show');
}

function clickButton(btn) {
    console.log("Bonton <<"+btn+">> cliqué");
    $.ajax({
		url: domain+"/click/"+btn,
		type: "get",
        cache: false,
        beforeSend: function(){
            console.log(btn);
		}
	}).done(function( msg ) {
        console.log(msg);
	});
}
