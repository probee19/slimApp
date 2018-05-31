
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
                    $caracteres = array('Confiança e lealdade são importantes para '.$_GET['User_name'].'. O mundo nem sempre o ajudou, mas sua perspectiva positiva lhe permitiu superar os maus momentos. Ele é ambicioso e ama tudo o que a vida tem para oferecer.',
                    'A vida nem sempre foi fácil com '.$_GET['User_name'].', Mas isso nunca a impediu de alcançar seus sonhos. Ele é ambicioso, leal e inspirador com todos ao seu redor. Ele continua a viver plenamente e ama desafios.',
                    'Confiança e lealdade descrevem bem '.$_GET['User_name'].'. A vida às vezes era dura, mas sua natureza forte e determinada permitia que ela passasse por momentos difíceis. Ninguém pode impedi-lo de alcançar seus sonhos, e sua atitude inspira outros a fazer o mesmo.',
                    ''.$_GET['user_name'].' vida amorosa! Apesar de ter meias, ele continua sendo uma pessoa forte e leal. Ele é honesto e ambicioso e atinge seus sonhos dia após dia. Ele nunca perde de vista quem ele realmente é!');
          }
          else{
                    $caracteres = array('Confiança e lealdade são importantes para '.$_GET['User_name'].'. O mundo nem sempre a ajudou, mas sua perspectiva positiva lhe permitiu superar os maus momentos. Ela é ambiciosa e ama tudo o que a vida tem para oferecer.',
                    'A vida nem sempre foi fácil com '.$_GET['User_name'].', Mas isso nunca a impediu de alcançar seus sonhos. Ela é ambiciosa, leal e inspira todos ao seu redor. Ela continua a viver uma vida plena e ama desafios.',
                    'Confiança e lealdade descrevem bem '.$_GET['User_name'].'. A vida às vezes era dura, mas sua natureza forte e determinada permitia que ela passasse por momentos difíceis. Ninguém pode impedi-lo de alcançar seus sonhos, e sua atitude inspira outros a fazer o mesmo.',
                    ''.$_GET['user_name'].' vida amorosa! Embora ela tenha meias, ela continua sendo uma pessoa forte e leal. Ela é ambiciosa e ambiciosa e realiza seus sonhos dia após dia. Ela nunca perde de vista quem ela realmente é!');
          }
          shuffle($caracteres);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524758800.png" id="back"> 
<div class="overlay"></div>

<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div class="texte" id="caractere"><?=$caracteres[0]?></div>


        </div>
        
        </body>
        </html>
      