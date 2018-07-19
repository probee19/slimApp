
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
              @font-face {
    font-family: orange;
    src: url("http://fr.funizi.com/src/fonts/orange/HelvNeue75_W1G.woff");
}
.main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#volume{z-index:1; font-family:"Arial",sans-serif;letter-spacing: -0.015em; font-weight: bold;position: absolute; left: 38px; top: 38px; color:#000; font-size:60px; width:350px ; height:350px ; border-radius:350px; display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

#forfait{z-index:1; font-family:"Arial",sans-serif; letter-spacing: -0.015em;font-weight: bold;position: absolute; right: 38px; top: 38px; color:#000; font-size:40px; line-height:55px; width:350px ; height:350px ;  display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
          $postes = array('');
          $img = array();
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1531998719.png" id="back"> 

<div class="texte" id="volume"> <?php echo $_GET['volume']; ?></div>

<div class="texte" id="forfait"><?php echo $_GET['forfait']; ?> <br> <?php echo $_GET['code']; ?> <br> Valable <?php echo $_GET['validite']; ?> </div>

        </div>
        
        </body>
        </html>
      