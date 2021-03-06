
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
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
#message{position:absolute; background:#000; border-radius:30px; z-index:2; right:20px; padding:20px; top:80px; width:440px; height:260px; font-size:26px; line-height:40px; text-align:center;color:#FFF;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
#fb_id_user{position: absolute; z-index:1; left: 60px; top: 100px; width:200px ;height:200px ; object-fit: cover; object-position: 50% 10%;  border-radius:100px; border:4px solid #000; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 0px; top: 330px; font-size:30px; color:#FFF; text-align:center; width:320px; font-weight:400px;} 
#name_contour{ color:#FFF; background: #000; padding:10px; border-radius:20px;} 
.titre{position:absolute;  z-index:3; top: 0; left: 0;width:100%; padding-top:10px; padding-bottom:10px; background:#000; text-align:center; font-size:30px; color: #FFF;font-family: 'Lobster', cursive; }

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
$message = array("Gracias a las buenas obras, recibirá dinero que no espera y buenas noticias. Ganarás en todos los frentes.",
"Tendrás un viaje largo con dos amigos cercanos. En el camino, conocerás nuevas caras que tendrán un gran impacto en tu vida en 2018. Emocionante.",
"Un gran cambio en la última semana del mes lo ayudará a concentrarse en sus objetivos para el próximo año. Planearás la mejor aventura de tu vida.",
"Conocerás el amor de tu vida, pero no de la forma en que lo imaginas. Una fiesta en la casa de un amigo provocará los eventos.");
shuffle($message);
?>

<div id="titre" class="titre">¿Qué te reserva el mes de mayo?</div>
<img src="http://creation.funizi.com/images-theme-perso/1509379734.jpg" id="background"> 

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><span id="name_contour"><?php echo urldecode($_GET['user_name']); ?></span></div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?>
</div>

        </div>
        
        </body>
        </html>
      