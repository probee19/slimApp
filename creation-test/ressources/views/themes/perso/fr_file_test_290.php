
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Chewy|Contrail+One" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden;  }
.main img{ position:absolute; max-height:420px; max-width:800px; }

#back{position:absolute; z-index:1; left:0; top:0; width:800px; height:420px; opacity:0.8;}

#fb_id_user{position:absolute; z-index:1; left: 60px; top: 30px; width:200px ; border-radius:200px; max-width:800px; max-height:420px;}
#name_user, #personnage{position:absolute;font-family: 'Chewy', cursive; z-index:1; display:flex;justify-content:center; align-items:center; font-size:30px; color:#FFF; width:240px; height:40px; background:#B71C1C; }
#name_user{left: 40px; top: 240px;} 

#personnage{right: 40px; top: 240px; }

#img_personnage{position:absolute; z-index:1; right:60px; top:30px; width:200px ; height:200px; border-radius:200px;  }

#details{z-index:1; font-family: 'Contrail One', cursive;position: absolute; left: 30px; bottom: 0; color:#FFF; font-size:35px; line-height:40px; width:740px ; height:130px ;  padding:5px; display:flex; align-items:center; text-align:center;
 text-shadow: -1px -1px 0 #000, 1px -1px 0 #000,  -1px 1px 0 #000, 1px 1px 0 #000;  }

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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
                    $personnages = array('T\'Challa','T\'Chaka','N\'Jadaka','Everett K. Ross','Ulysses Klaue','M\'Baku','Zuri');
                    $images = array('1519661677','1519662644','1519662729','1519663067','1519663366','1519663616','1519663857');
                    $details = array(' Tu es un vrai justicier et capable de tout pour protéger les tiens. ',' Tu es aimé, respecté et capable de garder des secrets qui menacent la stabilité de ton pays. ',
                    ' Tu es un redoutable combattant doté d’une extraordinaire intelligence ','',' Tu es un scientifique de haut niveau et tu possèdes une force et une endurance surhumaine ',
                    ' Tu es un grand chef et tu possèdes des aptitudes surhumaines. ',' Tu es un conseiller fidèle, un homme de confiance. ');
                    $ind = mt_rand(0,6);
          }
          else{
                    $personnages = array('Ramonda','Nakia','Okoye','Shuri');
                    $images = array('1519662856','1519662954','1519663017','1519663589');
                    $details = array(' Tu es une conseillère discrete, une reine mère. ',
                    ' Tu es une vraie guerrière capable de mener n\'importe quelle mission pour libérer les opprimés. ',' Tu es une générale loyale et dévouée. ',
                    ' Tu es une princesse, un génie capable d\'être responsable de plusieurs innovations technologiques. ');
                    $ind = mt_rand(0,3);
          }
          
          
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1519658734.jpg" id="back"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>

<div class="texte" id="personnage"> <?=$personnages[$ind];?> </div>

<img src="https://creation.funizi.com/images-theme-perso/<?=$images[$ind]; ?>.jpg" id="img_personnage"> 

<div class="texte" id="details"><?=$details[$ind];?> </div>




        </div>
        
        </body>
        </html>
      