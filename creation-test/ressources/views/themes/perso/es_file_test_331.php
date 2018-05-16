
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
                    $caracteres = array('La confianza y la lealtad son importantes para '.$_GET['User_name'].'. El mundo no siempre lo ayudó, pero su actitud positiva le permitió atravesar los malos momentos. Él es ambicioso y ama todo lo que la vida tiene para ofrecer.',
                    'La vida no siempre ha sido fácil con '.$_GET['¿User_name'].', Pero eso nunca le ha impedido alcanzar sus sueños. Él es ambicioso, leal e inspirador con todos los que lo rodean. Él continúa viviendo su vida completamente y ama los desafíos.',
                    'La confianza y la lealtad se describen bien '.$_GET['User_name'].'. La vida a veces era dura, pero su naturaleza fuerte y decidida le permitía pasar por momentos difíciles. Nadie puede evitar que alcance sus sueños, y su actitud inspira a otros a hacer lo mismo.',
                    ''.$_GET['nombre_usuario'].' vida amorosa! Aunque tenía medias, sigue siendo una persona fuerte y leal. Él es honesto y ambicioso, y alcanza sus sueños día tras día. ¡Nunca pierde de vista quién es realmente!');
          }
          else{
                    $caracteres = array('La confianza y la lealtad son importantes para '.$_GET['User_name'].'. El mundo no siempre la ha ayudado, pero su actitud positiva le ha permitido superar los malos momentos. Ella es ambiciosa y ama todo lo que la vida tiene para ofrecer.',
                    'La vida no siempre ha sido fácil con '.$_GET['¿User_name'].', Pero eso nunca le ha impedido alcanzar sus sueños. Ella es ambiciosa, leal e inspira a todos a su alrededor. Ella continúa viviendo una vida plena y ama los desafíos.',
                    'La confianza y la lealtad se describen bien '.$_GET['User_name'].'. La vida a veces era dura, pero su naturaleza fuerte y decidida le permitía pasar por momentos difíciles. Nadie puede evitar que alcance sus sueños, y su actitud inspira a otros a hacer lo mismo.',
                    ''.$_GET['nombre_usuario'].' vida amorosa! Aunque tenía medias, sigue siendo una persona fuerte y leal. Ella es ambiciosa y ambiciosa, y logra sus sueños día tras día. ¡Nunca pierde de vista quién es realmente!');
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
      