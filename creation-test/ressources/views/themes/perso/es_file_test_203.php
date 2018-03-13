
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
#bottom{ position:absolute; height:120px; width:800px; bottom:0; text-align:center;background:#000; padding-top:65px; }
#mot{ color:#FFF; font-size: 70px;
    background: -webkit-linear-gradient(#0080FF, #99CCFF);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;font-family: 'Archivo Black', sans-serif;}
.photo{ position:absolute;z-index:2;overflow: hidden; height:244px; width:262px; }
.photo img{top:-11Px;}
.img_profile{width:262Px;}
#result1 {position:absolute;left:0;bottom:0;width:262px;height:170px;background:#4300FF; text-align:center; color:#FFF; font-size:26px; line-height:30px;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */}
#result2 {position:absolute;left:269px;top:0;width:262px;height:121px;background:#E11700;text-align:center; color:#FFF; font-size:26px; line-height:30px;;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */}
#result3 {position:absolute;right:0;bottom:0;width:262px;height:170px;background:#A900E1; color:#FFF; font-size:26px; line-height:30px;text-align:center;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */}
#name_user {position:absolute;left:269px;bottom:0;width:262px;height:43px;background:#E100BC; color:#FFF; font-size:18px; font-weight:bold;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */}

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
                     $texte = array('Siempre das con el corazón','Nunca decepcionarás a nadie','No necesitas a nadie','Usted tiene la preocupación de los detalles',
                     'Nunca lastimarás a nadie','No te detengas ante nada','Pasarías por un incendio para salvar a tu familia',
                     'Odias la injusticia','Nunca te rindes a las personas','Tu lealtad es infalible','Aprendes de tus errores','Siempre cuidas de tus amigos','Siempre eres honesto con las personas');

  }
            else{ 
             $texte = array('contento','Líder','Honesto','Poderoso','Sabio','Éxito');

            }
shuffle($texte);
?>

<div class='photo' style="top:0;left:0">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div id="result1">
<?php echo $texte[0]; ?>
</div>
<div id="result2">
<?php echo $texte[1]; ?>
</div>
<div class='photo' style="top:127px;left:269px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div id="result3">
<?php echo $texte[2]; ?>
</div>
<div id="name_user">
<?php echo $_GET['user_name']; ?>
</div>
<div class='photo' style="top:0;right:0px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>

        </div>
        
        </body>
        </html>
      