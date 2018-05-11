
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
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
#texte{position:absolute; z-index:1; left:50px; top:210px;  width:700px; max-height:420px; font-size:30px; color:#333; text-align:center; font-weight:bold; font-family: 'Bree Serif', serif; }
#name{width:700px; max-height:420px; font-size:30px; color:#999; text-align:center; font-weight:bold; margin-top:20px; font-size:20px; }

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
              $texte = array("Secretamente en una relación","Olvidado en la zona de amigos","En una relación con Vodka","Sexy, gratis y soltero",
"Esperando un milagro","Amantes de alguien tomado","No entiende nada a las mujeres");     }
            else{ 
              $texte = array("Secretamente en una relación","Olvidado en la zona de amigos","En una relación con Vodka","Sexy, gratis y soltero",
"Esperando un milagro","Enamorado de alguien tomado","No entiende nada con los hombres");
            }

 shuffle($texte);
 ?>
<img src="http://creation.funizi.com/images-theme-perso/1509236995.jpg" id="background">
<div id="texte"> <?php echo $texte[0]; ?>
<div id="name"><?php echo $_GET['full_user_name']; ?></div>
</div>

        </div>
        
        </body>
        </html>
      