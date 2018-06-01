
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
#img_user{position: absolute;z-index:1; left: 70px; top: 77px; width:200px ; max-width:800px; max-height:420px; border-radius:100px; border:4px solid #666; max-width:800px; max-height:420px; box-shadow: 0px 0px 55px #000;} 
#name_user{position:absolute; z-index:1;text-align:center;  left: 50px; width:240px;
            text-align:center; font-weight:bold; top: 300px; font-size:20px; color:#666;font-family: 'Paytone One', sans-serif;} 
#message{position:absolute; z-index:2; left:473px; top:55px; width:280px; height:276px; font-size:80px; line-height:50px;font-family: 'Paytone One', sans-serif; text-align:center;color:#E83140;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
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
      
<img src="http://creation.funizi.com/images-theme-perso/1508847761.jpg" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="img_user">
<span id="name_user" class="name"> <?php echo urldecode($_GET['user_name']); ?> </span>
<div style="position:absolute; left:290px;top:180px;z-index:2; width:180px;text-align:center; font-size:20px;font-family: 'Paytone One', sans-serif; color:#666"> 
           <?php

            if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
                echo 'admiré par';     }
            else{ 
              echo 'admirée par';
            }
            $max_key = 2; $key = mt_rand(0,$max_key); setlocale(LC_ALL, 'fr_FR'); $min_1 = mt_rand(10,32); $min_2 = $min_1 + 11; $min_3 = $min_1 + 17;
            ?></div>
<div id="message"> 
<?php
$initiale =  substr(urldecode($_GET['friend_name_1']), 0, 1);  
echo $initiale." "
?>
</div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      