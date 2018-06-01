
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Hi+Melody|Bree+Serif" rel="stylesheet">
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

#last_name{z-index:1;font-family: 'Hi Melody', cursive;  text-transform:uppercase; position: absolute; left: 0; top: 30px; color:#1A237E; font-size:100px; line-height:100px; font-weight:700; width:800px ; height:50px ; text-align:center; max-width:800px; max-height:420px;}
.texte{z-index:1; font-family: 'Bree Serif', serif;  letter-spacing:3px; position: absolute; left: 0; color:#000; font-size:45px; width:800px ; height:50px ; text-align:center; max-width:800px; max-height:420px;}
#texte1{top: 180px; text-transform:uppercase;}
#texte2{top: 250px;  font-size:35px;}
#texte3{top: 320px;  font-size:50px; text-transform:uppercase; }
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
          $significations = array('Confiar em','fidelidade','Paz','prosperidade','bravura','coragem','dignidade','bondade','força');
          shuffle($significations);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1525342466.jpg" id="back"> 
 
<div class="texte" id="last_name"><?php echo urldecode($_GET['additionnal_input_text']); ?></div>
 
<div class="texte" id="texte1"> Sangue real de 100% </div>
<div class="texte" id="texte2"> significa </div>
<div class="texte" id="texte3"> <?=$significations[0]?> e <?=$significations[1]?> </div>
 

        </div>
        
        </body>
        </html>
      