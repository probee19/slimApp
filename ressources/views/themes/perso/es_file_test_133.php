
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              
              <title>Theme 4</title>
              <style>
                  body{font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
                  .main{
                      padding:0;
                      margin:0;
                      width: 800px;
                      height:420px;
                      position: relative;
                      overflow: hidden;
                  }
              .texte2{
                width: 200px;
              }
                          #theme-perso{position: relative; width: 804px; height: 424px; overflow:hidden;}
            #theme-perso img{position:absolute; max-height:420px; max-width:800px; }
            #background{z-index:0; left:0; top:0; max-width:800px; max-height:420px; }
            #fb_id_friend_1{position: absolute; z-index:1; left: 9px; top: 9px; width:102px ; border-radius:102px; }
            #name_friend_1{position:absolute; z-index:1; left: 145px; top: 17px; font-size:24px; color:#000; font-weight:700;}
            #fb_id_friend_2{position: absolute; z-index:1; right: 7px; top: 147px; width:102px ; border-radius:102px; }
            #name_friend_2{position:absolute; z-index:1; right: 145px; top: 155px; font-size:24px; color:#FFF; font-weight:700;}
            #fb_id_friend_3{position: absolute; z-index:1; left: 9px; top: 282px; width:102px ; border-radius:102px; }
            #name_friend_3{position:absolute; z-index:1; left: 145px; top: 293px; font-size:24px; color:#000; font-weight:700;}
            #message_1{position:absolute; z-index:1; left: 145px; top: 53px; font-weight:400; color:#000; font-size:22px; width:510px ; height:60px ; text-align:left; }
            #message_2{position:absolute; z-index:1; right: 145px; top: 188px; font-weight:400; color:#FFF; font-size:22px; width:510px ; height:60px ; text-align:right; }
            #message_3{position:absolute; z-index:1; left: 145px; top: 328px; font-weight:400; color:#000; font-size:22px; width:510px ; height:60px ; text-align:left; }
            #date_1{position:absolute; z-index:1; left: 145px; top: 105px; font-weight:500; color:#000; font-size:14; padding:5px; text-align:left; }
            #date_2{position:absolute; z-index:1; right: 145px; top: 245px; font-weight:500; color:#FFF; font-size:14; padding:5px; text-align:left; }
            #date_3{position:absolute; z-index:1; left: 145px; top: 380px; font-weight:500; color:#000; font-size:14; padding:5px; text-align:left; }
        
              </style>
              <script src='../../../src/js/jquery.js'></script>
              <script>
                  $(document).ready(function(){
                var autoSizeText;
                autoSizeText = function() {
                  var el, elements, _i, _len, _results;
                  elements = $('.texte2');
                  console.log(elements);
                  if (elements.length < 0) {
                    return;
                  }
                  _results = [];
                  for (_i = 0, _len = elements.length; _i < _len; _i++) {
                    el = elements[_i];
                    _results.push((function(el) {
                      var resizeText, _results1;
                      resizeText = function() {
                        var elNewFontSize;
                        elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                        return $(el).css('font-size', elNewFontSize);
                      };
                      _results1 = [];
                      while (el.scrollHeight > el.offsetHeight) {
                        _results1.push(resizeText());
                      }
                      return _results1;
                    })(el));
                  }
                  return _results;
                };
                autoSizeText();
                  // JAVASCRIPT

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
            <!DOCTYPE HTML>
            <?php

            if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
                $message_1 = array('Se enteró que '.$_GET['¿User_name'].' Iba a las Maldivas?', 'Odio cuando '.$_GET['¿User_name'].' Entra en una habitación, todos lo miran', 'Fiesta secreta VIP esta noche, ¿estás invitado? User_name'].'?','Haz visto '.$_GET['User_name'].' ¿Últimamente? Oh querido !','Acabo de ver '.$_GET['User_name'].' En una limusina!','Has visto '.$_GET['¿User_name'].' ¿En la fiesta de ayer? !!');
                $message_2 = array('¡Sí, lo vi! Cómo ? ¿De dónde sacó el dinero para este viaje?', 'Es porque es el más interesante', 'Este es nuestro amigo más glamoroso, por supuesto! Tenemos que estar a la altura de','Está vacío ! Él tiene clase ahora. No es justo.','¿Grave? Es una locura !','¡Grave! ¿Desde cuándo se viste también?');
                $message_3 = array('Él es muy misterioso ...', 'Eso es verdad. Es una verdadera estrella', ' Si hay un VIP en nuestro grupo, es bueno '.$_GET['User_name'].'!','Hay personas que me preguntan si está soltero','Él es cada vez más misterioso ...','Nadie podía quitarle los ojos de encima. Una verdadera estrella.');
            }
            else{ 
                $message_1 = array('Se enteró que '.$_GET['¿User_name'].' Iba a las Maldivas?', 'Odio cuando '.$_GET['User_name'].' Entra en una habitación, todos la miran', 'Fiesta secreta VIP esta noche, ¿estás invitado? User_name'].'?','Haz visto '.$_GET['User_name'].' ¿Últimamente? Oh querido !','Acabo de ver '.$_GET['User_name'].' En una limusina! ','Has visto '.$_GET['¿User_name'].' ¿En la fiesta de ayer? !!');
                $message_2 = array('¡Sí, lo vi! Cómo ? ¿De dónde sacó ella el dinero para este viaje?', 'Eso es porque es el más interesante', 'Ella es nuestra amiga más glamorosa, ¡por supuesto! Tenemos que estar a la altura de',' Está vacío ! ella tiene clase ahora. No es justo.','¿Grave? Es una locura !','¡Grave! ¿Desde cuándo se viste tan bien?');
                $message_3 = array('Ella es muy misteriosa ...', 'Eso es verdad. Es una verdadera estrella', ' Si hay un VIP en nuestro grupo, es bueno '.$_GET['User_name'].'!','Hay personas que me preguntan si está soltera',' Ella es cada vez más misteriosa ...','Nadie podría quitarle los ojos. Una verdadera estrella.');

            }
            $max_key = 5; $key = mt_rand(0,$max_key); setlocale(LC_ALL, 'fr_FR'); $min_1 = mt_rand(10,32); $min_2 = $min_1 + 11; $min_3 = $min_1 + 17;
            ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508415358.jpg" id="background">
            <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
            <span id="name_friend_1" class="name"><?php echo $_GET['friend_name_1']; ?></span>
            <span class="texte" id="message_1"> <?php echo $message_1[$key]; ?> </span>
            <span class="texte" id="date_1"> <?php echo strftime("%d-%m-%G").' à '.strftime("%H").':'.$min_1; ?> </span>
            <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_2">
            <span id="name_friend_2" class="name"> <?php echo $_GET['friend_name_2']; ?></span>
            <span class="texte" id="message_2"> <?php echo $message_2[$key]; ?> </span>
            <span class="texte" id="date_2"> <?php echo strftime("%d-%m-%G").' à '.strftime("%H").':'.$min_2; ?> </span>
            <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_3">
            <span id="name_friend_3" class="name"> <?php echo $_GET['friend_name_3']; ?></span>
            <span class="texte" id="message_3"> <?php echo $message_3[$key]; ?> </span>
            <span class="texte" id="date_3"> <?php echo strftime("%d-%m-%G").' à '.strftime("%H").':'.$min_3; ?> </span>

        

        </div>
        
        </body>
        </html>
      