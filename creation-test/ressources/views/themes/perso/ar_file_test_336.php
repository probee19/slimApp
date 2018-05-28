
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background:#000; opacity:0.7;}
.star{position:absolute; z-index:1; top:30px; }
#star1{left:300px;  }
#star2{left:360px;  }
#star3{left:420px;  }

.qualite{z-index:1; font-family: 'Merienda', cursive; position: absolute;  left: 30px; color:#FFF; font-size:30px; line-height:38px; width:740px ; height:70px ; display:flex; justify-content:center; align-items:center; text-align:center; }
#qualite1{top: 120px; }
#qualite2{top: 220px; }
#qualite3{top: 320px; }
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
          $qualites = array('{؟ user_name؟} يجعل الجميع يبتسم','{؟ ما زال يقاوم الظلم','{؟ user_name؟} جدير بالثقة','{؟ دائما؟ ابتسم دائما','{؟ هو دائما نصيحة جيدة');
          shuffle($qualites);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1525087856.jpg" id="back"> 

<div class="overlay"></div>

<img class="star" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star1">
<img class="star" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star2"> 
<img class="star" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star3">  

<div class="texte qualite" id="qualite1">1. <?=$qualites[0]?></div>
<div class="texte qualite" id="qualite2">2. <?=$qualites[1]?></div>
<div class="texte qualite" id="qualite3">3. <?=$qualites[2]?></div>
 



        </div>
        
        </body>
        </html>
      