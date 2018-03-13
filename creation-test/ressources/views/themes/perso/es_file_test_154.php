
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 337px; top: 41px; width:126px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:100px; color:#FFF;} 
#message_1{position:absolute; z-index:1; left: 50px; top: 190px; font-weight:bold; color:#FFF; font-size:28px; width:700px ; height:60px ; text-align:center; }
#message_2{position:absolute; z-index:1; left: 50px; top: 240px; font-weight:400; color:#FFF; font-size:32px; line-height:32px; width:700px ; height:160 ; text-align:center; }
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
$message_1 = array('No estés ahí para tus amigos','Elige un mal amigo','Perder a un amigo','Desperdicia tu amor por la persona equivocada');
$message_2 = array('Te preocupas tanto por tus amigos que tienes miedo de no estar allí cuando más lo necesitan. debes aceptar ser humano.',
'Tu error fue poner tu felicidad en manos de otra persona. Ahora has elegido ser responsable de tu propia felicidad para no repetir los errores del pasado.',
'Amas a tus amigos más que a nada en el mundo. siempre están ahí para ti y siempre estás ahí para ellos. Si tuviera que perder uno, estaría devastado.',
'Cuando te enamoras, caes muy duro. Para ti el amor es solo pasión, pero este amor no siempre se merece. Tómese su tiempo para elegir a la persona adecuada.');
$max_key = 3; $key = mt_rand(0,$max_key);                
?>
<img src="http://creation.funizi.com/images-theme-perso/1508586242.jpg" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
 <span class="texte" id="message_1"> <?php echo $message_1[$key]; ?> </span>
  <span class="texte" id="message_2"> <?php echo $message_2[$key]; ?> </span>

        </div>
        
        </body>
        </html>
      