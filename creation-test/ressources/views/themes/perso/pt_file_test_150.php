
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#position1_name_friend_1{position:absolute; z-index:1; left: 100px; top: 50px; font-size:18px; font-weight:bold; color:#FFF;} 
#message1{position:absolute; z-index:1; left: 100px; top: 80px; font-size:18px;color:#FFF;} 
#position2_name_friend_1{position:absolute; z-index:1; left: 100px; top: 190px; font-size:18px; font-weight:bold; color:#FFF;} 
#message2{position:absolute; z-index:1; left: 100px; top: 220px; font-size:18px;color:#FFF;} 
#position3_name_friend_1{position:absolute; z-index:1; left: 100px; top: 330px; font-size:18px; font-weight:bold; color:#FFF;}
#message3{position:absolute; z-index:1; left: 100px; top: 360px; font-size:18px;color:#FFF;} 
.name span{font-size:14px; font-weight:bold; color:#999;} 
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
                  //JavaScript

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<?php
 if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
               $message_1 = array('... e coloque sua roupa mais elegante! Será a noite da nossa vida!','Como você é minha melhor amiga, eu escolhi você!','Com você, isso seria completamente louco! Sem você, porém ...');
     }
            else{ 
           $message_1 = array('... e coloque sua roupa mais elegante! Será a noite da nossa vida!','Como você é minha melhor amiga, eu escolhi você!',
           'Com você, isso seria completamente louco! Sem você, porém ...');
 
            }

 
 $message_2 = array('Não me pergunte como eu fiz, mas consegui obter ingressos para a festa VIP desta noite. Responda!','... bom para duas pessoas!','Eu estava pensando em organizar uma festa louca, mas honestamente não ajuda muito se você não pode vir.');
 $message_3 = array('Chamadas perdidas (6)','Acabei de ganhar uma viagem ao Japão!','Espero que você não tenha planos para esta noite!');
 $max_key = 2; $key = mt_rand(0,$max_key);    
?>
<img src="http://creation.funizi.com/images-theme-perso/1508537456.jpg" id="background"> 
<div class="name texte" id="position1_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>Agora mesmo</span></div>
<div  id="message1" ><?php echo $message_1[$key]; ?></div>
<div class="name texte" id="position2_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>4 minutos atrás</span></div>
<div  id="message2" ><?php echo $message_2[$key]; ?></div>
<div class="name texte" id="position3_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>Há 6 minutos</span></div>
<div  id="message3" ><?php echo $message_3[$key]; ?></div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      