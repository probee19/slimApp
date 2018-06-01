
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background:#000; opacity:0.4;}

#fb_id_user{position: absolute; z-index:1; left: 350px; top: 30px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; -webkit-mask-image: linear-gradient( transparent 8%, black 25%);mask-image: linear-gradient(to right, transparent 8%, black 25%);}
#peur{z-index:1; position: absolute; font-family: 'Do Hyeon', sans-serif;left: 50px; bottom: 20px; color:#FFF; font-size:34px; line-height:40px; width:700px ; height:250px ;display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}
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
          
          $peurs = array('La idea de estar lejos de tu familia te aterroriza. Los amas tanto que siempre quieres estar con ella.',
          'Tu mayor temor es no poder decirle a tus amigos y familiares cuánto los amas todos los días.',
          'Tu familia te quiere mucho y has argumentado tan fuertemente que la idea de decepcionarte te rompe el corazón. Solo quieres ver sonrisas en sus caras.',
          'Tu familia es genial Usted comparte todo y sabe cómo apoyarse mutuamente. No estarás sin ellos.',
          'Tu mayor temor es separarte de tu mejor amigo. ¡Eres casi gemelo!',
          'Amas a tu familia más que a nada en el mundo. Te aterroriza perderlos. Estas son las personas más importantes en tu vida',
          'Tu familia es tu fuente de felicidad. No son solo personas con quienes comparte sangre, son sus mejores amigos y su mejor apoyo.');

          shuffle($peurs);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524925262.jpg" id="back"> 
<div class="overlay"></div>
  
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<div class="texte" id="peur"><?=$peurs[0]?></div>
 

        </div>
        
        </body>
        </html>
      