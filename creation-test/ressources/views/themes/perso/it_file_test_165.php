
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
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
#background{position:absolute; z-index:2; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 282px; top:96px; width:225px ; border-radius:100px; max-width:800px; max-height:420px;}
#aime{position:absolute; z-index:2; left:0; top:30px;  width:282px; max-height:420px; text-align:center; }
#couleur{position:absolute; z-index:2; left:282px; top:15px;  width:225px; height:96px; text-align:center; }
#force{position:absolute; z-index:2; right:0; top:30px;  width:282px; max-height:420px; text-align:center; }
#deteste{position:absolute; z-index:2; left:0; top:240px;  width:282px; max-height:420px; text-align:center; }
#personnalite{position:absolute; z-index:2; left:282px; top:330px;  width:225px; height:96px; text-align:center; }
#defaut{position:absolute; z-index:2; right:0; top:240px;  width:282px; max-height:420px; text-align:center; }
.titre_rubrique{font-size:23px;font-family: 'Acme', sans-serif; width:100%; }
.result{font-size:43px; margin-top:0px;font-family: 'Acme', sans-serif; color:#FFF; width:100%; }
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
                $aime = array('ridere','il tuo letto','i tuoi amici','la musica');
                $couleur = array('blu', 'rosso', 'verde','bianca','arancia');
                $force = array('sorriso magico','la semplicità','generosità','il vostro personaggio','il tuo cuore');
                $deteste = array('La bugia','la tua sveglia','Il tradimento','traffico','gli snob');
                $personnalite = array('ammirevole','creativo','determinato');
                $tondefaut = array('sensibile','perfezionista');
                shuffle($aime); shuffle($couleur); shuffle($force); shuffle($deteste); shuffle($personnalite); shuffle($tondefaut);
            ?>
<img src="http://creation.funizi.com/images-theme-perso/1508763145.png" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="aime"><span class="titre_rubrique">Ti piace</span><div class="result"><?php echo $nature[0] ?><?php echo $aime[0] ?></div></div>
<div id="couleur"><span class="titre_rubrique">Colore</span><div class="result" style="font-size:30px"><?php echo $couleur[0] ?></div></div>
<div id="force"><span class="titre_rubrique">La tua forza</span><div class="result"><?php echo $force[0] ?> </div></div>
<div id="deteste"><span class="titre_rubrique">Tu odi</span><div class="result"><?php echo $deteste[0] ?></div></div>
<div id="personnalite"><span class="titre_rubrique">Personalità</span><div class="result" style="font-size:30px"><?php echo $personnalite[0] ?></div></div>
<div id="defaut"><span class="titre_rubrique">Colpa tua</span><div class="result"><?php echo $tondefaut[0] ?></div></div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      