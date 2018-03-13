
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
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
#jauge_container{position:absolute; z-index:2; left:100px; top:266px;width:600px; height:67px; }
#jauge{z-index:2; background:#FFF; height:67px; text-align:center; font-size:50px; line-height:50px;font-family: 'Paytone One', sans-serif;}

#fb_id_user{position: absolute; z-index:1; left: 340px; top: 110px; width:120px ; border-radius:100px; border:3px solid #000; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 40px; font-size:40px; color:#FFF;font-family: 'Paytone One', sans-serif; width:800px;text-align:center;} 
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
      
<img src="http://creation.funizi.com/images-theme-perso/1508668164.png" id="background"> 
Code HTML : 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" >- <?php echo $_GET['user_name']; ?> -</div>

<div id="jauge_container">
<div id="jauge" style="width:<?php $pourcent=rand(90,100); echo $pourcent ?>%"><span style="font-size:20px">ist glücklich zu <?php echo $pourcent ?> %</div>
</div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      