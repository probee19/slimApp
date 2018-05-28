
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
                          #theme-perso{position: relative; width: 804px; height: 424px; overflow:hidden;}
            #theme-perso img{position:absolute; max-height:420px; max-width:800px; }
            .titre{position:absolute; top: 0; left: 0;  padding:10px; width:100%; background:#FFF; text-align:center; font-size:25px; color: #4BC9E3; font-weight:800px; }
            .texte{position:absolute; padding:20px; background:#FFF; border:0px solid #7E3300;border-radius:10px; width:400px; height:auto; font-size:55px; line-height:55px; color: #000; font-weight:800px; text-align:center; }
            #texte_1{left: 320px; top:140px; }
            #img_user{position: absolute;z-index:1; left: 55px; top: 77px; width:230px ; max-width:800px; max-height:420px;} 
            #name_user{position:absolute; z-index:1;text-align:center;  left: 50px; width:240px;
            text-align:center; font-weight:bold; top: 315px; font-size:20px; color:#000;} #background{z-index:0; left:0; top:0; width:800px; max-width:800px; max-height:420px; }
        
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
                $don = array('Deine Loyalität','Deine Ehrlichkeit','Dein zartes Herz','Dein natürlicher Charme','Dein Glaube','Deine Freundlichkeit','Dein Mitgefühl','Deine Ausdauer');
                shuffle($don);
            ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508587038.jpg" id="background">
            <span id="titre" class="titre">Welches Geschenk hast du von Gott erhalten?</span>
            <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="img_user">
            <span id="name_user" class="name"> <?php echo urldecode($_GET['user_name']); ?> </span>
            <span id="texte_1" class="texte"> <?php echo $don[0] ?></span>
           

        

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      