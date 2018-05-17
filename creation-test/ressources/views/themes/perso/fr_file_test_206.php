
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
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
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
 $texte = array('A baissé les bras','C&#39;est le bordel','Célibataire','Secrétement en couple');
 $texte1 = array('Hésite entre 2 personnes','Coeur brisé','Officiellement en couple','Enfin en couple','En couple et heureux','Pas touche! coeur déjà pris!');
 shuffle($texte);
 shuffle($texte1);
?>
<img src="http://creation.funizi.com/images-theme-perso/1510169321.png" id="back"> 
<div style=" position:absolute; width:800px; top:80px; text-align:center; z-index:2; font-size:30px; font-weight:bold"><?php echo $texte[0]; ?></div>
<div style=" position:absolute; width:800px; top:115px; text-align:center; z-index:2; font-size:20px; font-weight:bold; color:#0C6CFF">Aujourd&#39;hui</div>
<div style=" position:absolute; width:800px; top:140px; text-align:center; z-index:2; font-size:20px; font-weight:bold; color:#999"><?php echo urldecode($_GET['full_user_name']); ?></div>

<div style=" position:absolute; width:800px; top:295px; text-align:center; z-index:2; font-size:30px; font-weight:bold"><?php echo $texte1[0]; ?></div>
<div style=" position:absolute; width:800px; top:330px; text-align:center; z-index:2; font-size:20px; font-weight:bold; color:#0C6CFF">Dans 6 mois</div>
<div style=" position:absolute; width:800px; top:355px; text-align:center; z-index:2; font-size:20px; font-weight:bold; color:#999"><?php echo urldecode($_GET['full_user_name']); ?></div>


        </div>
        
        </body>
        </html>
      