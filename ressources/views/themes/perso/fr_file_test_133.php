
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
                $message_1 = array(' Tu as entendu que '.$_GET['user_name'].' partait aux Maldives ? ', ' Je déteste quand '.$_GET['user_name'].' rentre dans une pièce, tout le monde le regarde ', ' Fête VIP secrète ce soir, est-ce qu\'on invite '.$_GET['user_name'].' ? ',' Tu as vu '.$_GET['user_name'].' dernièrement ? Oh la la ! ',' Je viens de voir passer '.$_GET['user_name'].' dans une limousine ! ',' Tu as vu '.$_GET['user_name'].' à la soirée hier ?!! ');
                $message_2 = array(' Ouais, j\'ai vu! Comment ça se fait ? Où est-ce qu\'il a eu l\'argent pour ce voyage ? ', ' C\'est parce que c\'est le plus intéressant ', ' C\'est notre ami le plus glamour, bien sûr ! Il faut qu\'on soit à la hauteur ',' C\'est clair ! Il a la classe maintenant. C\'est pas juste. ',' Sérieux ? C\'est fou ! ',' Grave ! Depuis quand il s\'habille aussi bien ? ');
                $message_3 = array(' Il est trop mystérieux... ', ' C\'est vrai. C\'est une vrai star ', '  S\'il y\'a un VIP dans notre groupe, c\'est bien '.$_GET['user_name'].' ! ',' Il y\'a des gens qui me demandent s\'il est célibataire ',' Il est de plus en plus mystérieux... ',' Personne ne pouvait le quitter des yeux. Une vraie star. ');
            }
            else{ 
                $message_1 = array(' Tu as entendu que '.$_GET['user_name'].' partait aux Maldives ? ', ' Je déteste quand '.$_GET['user_name'].' rentre dans une pièce, tout le monde la regarde ', ' Fête VIP secrète ce soir, est-ce qu\'on invite '.$_GET['user_name'].' ? ',' Tu as vu '.$_GET['user_name'].' dernièrement ? Oh la la ! ',' Je viens de voir passer '.$_GET['user_name'].' dans une limousine !  ',' Tu as vu '.$_GET['user_name'].' à la soirée hier ?!! ');
                $message_2 = array(' Ouais, j\'ai vu! Comment ça se fait ? Où est-ce qu\'elle a eu l\'argent pour ce voyage ? ', ' C\'est parce que c\'est la plus intéressante ', ' C\'est notre amie la plus glamour, bien sûr ! Il faut qu\'on soit à la hauteur ','  C\'est clair ! elle a la classe maintenant. C\'est pas juste. ',' Sérieux ? C\'est fou ! ',' Grave ! Depuis quand elle s\'habille aussi bien ? ');
                $message_3 = array(' Elle est trop mystérieuse... ', ' C\'est vrai. C\'est une vrai star ', '  S\'il y\'a un VIP dans notre groupe, c\'est bien '.$_GET['user_name'].' ! ',' Il y\'a des gens qui me demandent si elle est célibataire ','  Elle est de plus en plus mystérieuse... ',' Personne ne pouvait la quitter des yeux. Une vraie star. ');

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
      