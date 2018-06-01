
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
            .titre{position:absolute; top: 0; left: 0;  padding:10px; width:100%; background:#000; text-align:center; font-size:25px; color: #FFF; font-weight:800px; }
            .texte{position:absolute; padding:10px; background:#FFF; border:2px solid #7E3300;border-radius:10px; font-size:25px; color: #000; font-weight:800px; }
            #texte_1{left: 400px; top:60px; } #texte_2{left: 400px; top:120px; } #texte_3{left: 400px; top:180px; } #texte_4{left: 400px; top:240px; } #texte_5{left: 400px; top:300px; } #texte_6{left: 400px; top:360px; }
            #img_user{position: absolute;z-index:1; left: 100px; top: 100px; width:200px ; border-radius:200px; max-width:800px; max-height:420px;} #name_user{position:absolute; z-index:1; width:220px ; text-align:center; padding:10px; border:2px solid #000; border-radius:10px; background:#3D2B1F; left: 90px; top: 320px; font-size:30px; color:#FFF;} #background{z-index:0; left:0; top:0; width:800px; max-width:800px; max-height:420px; }
        
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
      
            <?php
                $nature = array('Froh','glücklich');
                $personnalite = array('St.', 'Gläubige', 'ernst');
                $aime = array('Bescheidenheit','Die Einfachheit');
                $deteste = array('Die Lüge','Betrug','Der Verrat');
                $force = array('Motivation','Die Macht','Geld');
                $faiblesse = array('L\'excès d\'énergie ','L\'excès de zèle');
                shuffle($nature); shuffle($personnalite); shuffle($aime); shuffle($deteste); shuffle($force); shuffle($faiblesse);
            ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508245566.jpg" id="background">
            <span id="titre" class="titre"> Was ist deine Persönlichkeit <?php echo urldecode($_GET['user_name']); ?>?</span>
            <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="img_user">
            <span id="name_user" class="name"> <?php echo urldecode($_GET['user_name']); ?> </span>
            <span id="texte_1" class="texte"> <b>Natur :</b> <?php echo $nature[0] ?></span>
            <span id="texte_2" class="texte"> <b> Persönlichkeit:</b> <?php echo $personnalite[0] ?></span>
            <span id="texte_3" class="texte"> <b>Liebe :</b> <?php echo $aime[0] ?></span>
            <span id="texte_4" class="texte"> <b> Hass:</b> <?php echo $deteste[0] ?></span>
            <span id="texte_5" class="texte"> <b> Stärke :</b> <?php echo $force[0] ?></span>
            <span id="texte_6" class="texte"> <b> Die Schwäche :</b> <?php echo $faiblesse[0] ?></span>

        

        </div>
        
        </body>
        </html>
      