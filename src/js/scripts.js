$(document).ready(function () {
    $("#btn-result").removeClass("disabled");
    var id ='';
    var domain = $("#domain").data("domain");

    window.fbAsyncInit = function() {
        FB.init({
            appId: "<?php echo $_SESSION['fb_access_token']; ?>",
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
    openModalShare();

    $("#btn-show-discover-block").click(function (){
        $('html, body').animate({
            scrollTop: $("#discover-section").offset().top
        }, 1500);
    });

    $(".btn_to_track").on("click", function () {
        //clickButton($(this).attr("data-btn"));
    });

    $("#btn-result").on("click", function (e) {
        $(this).removeClass("disabled");
        console.log('Test en cours');
    });

    // Click event on pressing enter key from additionnal_input_text


    $('#additionnal_input_text').keypress(function (e) {
        var additionnalInputText = $('#additionnal_input_text').val();
        var n = additionnalInputText.length + 1;

        var key = e.which;
        if(key === 13 && n >= 1 ) // the enter key code
        {
          $('#btn-result').click();
         return false;
        }
        else {
          console.log(n);
        if(n >= 1 )
          $('#btn-result').fadeIn('fast');
        else
          $('#btn-result').fadeOut('fast');
        }
    });


    // Align modal when it is displayed
    $(".modal").on("shown.bs.modal", alignModal);

    // Align modal when user resize the window
    $(window).on("resize", function(){
        $(".modal:visible").each(alignModal);
    });

});

function alignModal(){
      var modalDialog = $(this).find(".modal-dialog");
      /* Applying the top margin on modal dialog to align it vertically center */
      modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
  }


function setSessionVar (varName, value, id, loader_on = false){

  if(loader_on == true) loader();
  $.ajax({
      url: domain+'/setSessionVar',
      type: 'post',
      data: {'varName': varName, 'value': value},
      success:function(data){
          //console.log(data);
          window.location.replace(domain+"/start/" + id);
      },
      error:function(response){
          //console.log(response);
      }
  });
}
function setSessionVarCDM (varName, countryCode, countryName, idTest, loader_on = false){

  if(loader_on == true) loader();
  $.ajax({
      url: domain+'/setSessionVarCDM',
      type: 'post',
      data: {'varName': varName, 'countryCode': countryCode, 'countryName': countryName},
      success:function(data){
          //console.log(data);
          window.location.replace(domain+"/start/" + idTest);
      },
      error:function(response){
          //console.log(response);
      }
  });
}



function changeLang(lang) {
  var uri = $('#domain').data('resquest-uri');
  var definedDomain = $('#domain').data('defined-domain');
  if (uri.indexOf('?') >= 0)
    window.location.replace('https://' + lang + '.' + definedDomain + uri + '&utm_source=funizi&utm_medium=select&utm_campaign=select_lang');
  else
    window.location.replace('https://' + lang + '.' + definedDomain + uri + '?utm_source=funizi&utm_medium=select&utm_campaign=select_lang');

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


function openModalShare(){
    //var mymodal = $('#discovery-tests-modal');
    if($('#discovery-share-modal').length > 0)
      setTimeout(function () {
        $('#discovery-share-modal').modal('show');
      }, 4000);
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





// Design / Dribbble by:
// Oleg Frolov
// URL: https://dribbble.com/shots/3072293-Notify-me

$(".cta ").click(function(){
  $(".cta:not(.sent)").addClass("active");
  $(".inputsubnewsletter > input").focus();
});

var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

$(".inputsubnewsletter > input").on('input', function(){
  if(regex.test($(this).val())) {
    $(".buttonsubnewsletter > button").removeAttr("disabled"); }
  else {
    $(".buttonsubnewsletter > button").attr("disabled", "disabled"); }
});

$("form").submit(function(x){
  x.preventDefault();
  if(regex.test($(".inputsubnewsletter > input").val())) {

    email = $(".inputsubnewsletter > input").val();

    $.ajax({
      url: domain+"/save-subscription-to-newsletter",
      type: "post",
      cache: false,
      data:{ 'email' : email},
      beforeSend: function(){
          thank = $("#sign_up_newsletter_thank").val();
          $(".cta span").text(thank);
          $(".cta").removeClass("active").addClass("sent");
          console.log(thank);
      }
    }).done(function( msg ) {
        console.log(msg);
    });

  }
});
