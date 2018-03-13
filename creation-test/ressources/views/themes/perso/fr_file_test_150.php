
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
               $message_1 = array('... et mets ta tenue la plus classe! Ca va être la soirée de notre vie!','Etant donné que tu es mon meilleur ami, c&#39;est toi que j&#39;ai choisi!','Avec toi, ça serait complètement taré! Sans toi, par contre ...');
     }
            else{ 
           $message_1 = array('... et mets ta tenue la plus classe! Ca va être la soirée de notre vie!','Etant donné que tu es ma meilleure amie, c&#39;est toi que j&#39;ai choisi!',
           'Avec toi, ça serait complètement taré! Sans toi, par contre ...');
 
            }

 
 $message_2 = array('Ne me demande pas de commentaire J&#39;ai fait mais j&#39;ai réussi à avoir des billets pour la fête VIP de ce soir. Réponds!','... bon pour deux personnes!','Je pensais organiser une fête de folie mais honnêtement cela ne sert pas à grand choix si tu ne peux pas venir.');
 $message_3 = array('Appels manqués (6)','Je viens de gagner un voyage au Japon!','J&#39;espère que tu n&#39;as pas de projet pour ce soir!');
 $max_key = 2; $key = mt_rand(0,$max_key);    
?>
<img src="http://creation.funizi.com/images-theme-perso/1508537456.jpg" id="background"> 
<div class="name texte" id="position1_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>à l&#39;instant</span></div>
<div  id="message1" ><?php echo $message_1[$key]; ?></div>
<div class="name texte" id="position2_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>il y&#39;a 4 minutes</span></div>
<div  id="message2" ><?php echo $message_2[$key]; ?></div>
<div class="name texte" id="position3_name_friend_1" ><?php echo $_GET['friend_name_1']; ?> <span>il y&#39;a 6 minutes</span></div>
<div  id="message3" ><?php echo $message_3[$key]; ?></div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      