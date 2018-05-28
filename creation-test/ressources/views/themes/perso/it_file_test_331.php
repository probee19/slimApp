
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam|Sacramento" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  }
#caractere{z-index:1; font-family: 'Kalam', cursive; position: absolute; left: 50px; bottom: 30px; color:#FFF; font-size:33px; line-height:48px; width:700px ; height:310px ; display:flex; align-items:center; justify-content:center; text-align:center;  }
.overlay{position:absolute; z-index:1; left:0; top:0; width:800px; height:420px; background:#000; opacity:0.5;}

#name_user{position:absolute; z-index:1; left: 0; top: 30px;font-family: 'Sacramento', cursive; font-size:50px; line-height:50px; text-align:center; width:800px; height:40px; color:#FFF;} 
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
                    $caracteres = array('Fiducia e lealtà sono importanti per '.$_GET['Nome utente'].'. Il mondo non sempre lo ha aiutato, ma la sua prospettiva positiva gli ha permesso di superare i brutti momenti. È ambizioso e ama tutto ciò che la vita ha da offrire.',
                    'La vita non è sempre stata facile con '.urldecode($_GET['user_name']).', Ma questo non l\'ha mai impedita di raggiungere i suoi sogni. È ambizioso, leale e stimolante con tutti quelli che lo circondano. Continua a vivere pienamente la sua vita e ad amare le sfide.',
                    'Fiducia e lealtà descrivono bene '.$_GET['Nome utente'].'. La vita era a volte dura, ma la sua natura forte e determinata le permetteva di attraversare momenti difficili. Nessuno può impedirgli di raggiungere i suoi sogni, e il suo atteggiamento ispira gli altri a fare lo stesso.',
                    ''.urldecode($_GET['user_name']).' ama la vita! Sebbene avesse delle calze, rimane una persona forte e leale. È onesto e ambizioso e raggiunge i suoi sogni giorno dopo giorno. Non perde mai di vista chi è veramente!');
          }
          else{
                    $caracteres = array('Fiducia e lealtà sono importanti per '.$_GET['Nome utente'].'. Il mondo non l\'ha sempre aiutata, ma la sua prospettiva positiva le ha permesso di superare i brutti momenti. È ambiziosa e ama tutto ciò che la vita ha da offrire.',
                    'La vita non è sempre stata facile con '.urldecode($_GET['user_name']).', Ma questo non l\'ha mai impedita di raggiungere i suoi sogni. Lei è ambiziosa, leale e ispira tutti intorno a lei. Lei continua a vivere una vita piena e ama le sfide.',
                    'Fiducia e lealtà descrivono bene '.$_GET['Nome utente'].'. La vita era a volte dura, ma la sua natura forte e determinata le permetteva di attraversare momenti difficili. Nessuno può impedirgli di raggiungere i suoi sogni, e il suo atteggiamento ispira gli altri a fare lo stesso.',
                    ''.urldecode($_GET['user_name']).' ama la vita! Sebbene avesse delle calze, rimane una persona forte e leale. È ambiziosa e ambiziosa e realizza i suoi sogni giorno dopo giorno. Non perde mai di vista chi è veramente!');
          }
          shuffle($caracteres);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524758800.png" id="back"> 
<div class="overlay"></div>

<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>
<div class="texte" id="caractere"><?=$caracteres[0]?></div>


        </div>
        
        </body>
        </html>
      