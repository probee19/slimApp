
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
#background{position:absolute; z-index:2; right:0; top:0;  width:500px; height:420px; background:#337AB7;}
#ilsdisent{position:absolute; z-index:2; right:0; top:40px; width:500px; height:40px;color:#FBFF08; text-align:center; font-size:30px;}
#signature{position:absolute; z-index:2; right:0; bottom:20px; width:500px; height:40px;color:#FBFF08; text-align:center; font-size:30px;}
#fb_id_user{position: absolute; z-index:1; left: -100px; top: 0px; width:420px ; border-radius:0px; max-width:800px; max-height:420px;}
#message{position:absolute; z-index:2; right:25px; top:20px; width:450px; height:380px; font-size:30px; line-height:35px; text-align:center;color:#FFF;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
#cadeau{position:absolute; z-index:2; left:230px; bottom:10px;  max-width:800px; max-height:420px; }

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
$message = array('Vous avez rempli ma vie avec vos sourires et votre amour. Vos visages me remplissent de joie et de fierté. Vous m\'avez changé d\'une telle façon que je n\'aurais jamais pu l\'imaginer et je vous en suis éternellement reconnaissant.',
               'Je n\'aurais jamais imaginé changer à ce point grâce à vous. Vous me remplissez de bonheur. Vous faites ma fierté et j\'en remercie le Seigneur chaque jour.');
               
      if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
                     
               $message2="Joyeux Noël, Papa";
            }
            else{ 
               $message2="Joyeux Noël, Maman";
            }

shuffle($message);
?>
<div id="background"></div> 
<div id="ilsdisent">Chers enfants</div> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?>
</div>
<div id="signature"> <?php echo $message2; ?></div> 
<img src="http://creation.funizi.com/images-theme-perso/1511006992.png" id="cadeau"> 



        </div>
        
        </body>
        </html>
      