
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
            .titre{position:absolute; top: 0; left: 0;  padding:10px; width:100%; background:#000; text-align:center; font-size:25px; color: #FFF; font-weight:800px; }
            .texte{position:absolute; padding:20px; background:#FFF; border:0px solid #7E3300;border-radius:10px; width:400px; font-size:25px; color: #000; font-weight:800px; }
            #texte_1{left: 350px; top:80px; } #texte_2{left: 350px; top:160px; } #texte_3{left: 350px; top:240px; }
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
                $apparence = array('charismatisch','atemberaubend','majestätisch');
                $ame = array('Magnetisch', 'Göttlich', 'reinigen');
                $personnalite = array('Charmeur','anerkannt','Demütigen');
                shuffle($apparence); shuffle($ame); shuffle($personnalite);
            ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508541310.jpg" id="background">
            <span id="titre" class="titre">Welche Geheimnisse verbergen sich hinter deinem Profilbild?</span>
            <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="img_user">
            <span id="name_user" class="name"> <?php echo $_GET['user_name']; ?> </span>
            <span id="texte_1" class="texte"> <b> Aussehen:</b> <?php echo $apparence[0] ?></span>
            <span id="texte_2" class="texte"> <b> Seele:</b> <?php echo $ame[0] ?></span>
            <span id="texte_3" class="texte"> <b> Persönlichkeit:</b> <?php echo $personnalite[0] ?></span>
           

        

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      