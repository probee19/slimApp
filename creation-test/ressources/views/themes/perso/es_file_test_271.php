
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:900" rel="stylesheet">
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
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 20px; top: 86px; width:166px ; border:3px solid #D0251D; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#message{position:absolute; z-index:1; top: 360px; left: 10px; font-size:30px; color:#000;font-family: 'Alegreya Sans', sans-serif; width:700px; line-height:25px;} 
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
               $message_1 = array(''.urldecode($_GET['user_name']).' ha sido elegido presidente de su país con el 98.9% de los votos',''.urldecode($_GET['user_name']).' acaba de ser votado como el hombre más hermoso del universo',
               ''.urldecode($_GET['user_name']).' se convierte en la segunda fortuna mundial detrás de Bill Gates',
               ''.urldecode($_GET['user_name']).' acaba de comprar su propio país',
               ''.$_GET['nombre_usuario'].' descubre una cura para el cáncer',
               ''.urldecode($_GET['user_name']).' previene una invasión alienígena',
               ''.urldecode($_GET['user_name']).' hace la paz en el mundo');
     }
            else{ 
           $message_1 = array(''.urldecode($_GET['user_name']).' ha sido elegido presidente de su país con el 96.9% de los votos', ''.urldecode($_GET['user_name']).' ha sido elegida la mujer más hermosa del universo',
           ''.urldecode($_GET['user_name']).' se convierte en la segunda fortuna mundial detrás de Bill Gates',
               ''.urldecode($_GET['user_name']).' acaba de comprar su propio país',
               ''.$_GET['nombre_usuario'].' descubre una cura para el cáncer',
               ''.urldecode($_GET['user_name']).' previene una invasión alienígena',
               ''.urldecode($_GET['user_name']).' hace la paz en el mundo');
 
            }
$max_key = 5; $key = mt_rand(0,$max_key);    
?>
<img src="http://creation.funizi.com/images-theme-perso/1518111094.png" id="back"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="" id="message" ><?php echo $message_1[$key] ?></div>


        </div>
        
        </body>
        </html>
      