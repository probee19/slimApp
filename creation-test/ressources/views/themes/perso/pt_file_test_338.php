
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bangers|Merienda" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #F5F5F5;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
.overlay{position: absolute; z-index:1; left: 0; top: 0; width:500px ;  height:420px ; background:#F5F5F5;}
.texte{position:absolute; z-index:1; left: 0; display:flex; align-items:center; justify-content:center; text-align:center;}
#fb_id_friend_1{position: absolute; z-index:1; right: -60px; top: 0; width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%;  }
#name_friend_1{font-family: 'Merienda', cursive; font-weight:700; top: 25px; width:500px; height:80px; font-size:45px; color:#1A237E; } 
#texte1{ font-family: 'Merienda', cursive; top: 105px; width:500px; height:50px; font-size:35px; color:#000; } 
#name_user{ font-family: 'Merienda', cursive; font-weight:700; top: 155px; width:500px; height:80px; font-size:50px; color:#1A237E; } 
#count{ font-family: 'Bangers', cursive; top: 235px; width:500px; height:80px; font-size:70px; color:#D50000; } 
#mois{ font-family: 'Merienda', cursive; top: 315px;  width:500px; height:80px; font-size:35px; color:#000; } 

#eye{position:absolute; z-index:1; right:120px; bottom:10px;  }
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
      
<!DOCTYPE HTML>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="overlay"></div>
<div class="texte" id="name_friend_1" ><?php echo $_GET['friend_first_name_1']; ?></div>
<div class="texte" id="texte1" >deu uma olhada</div>
<div class="texte" id="name_user" > <?php echo $_GET['user_name']; ?> </div>
<div class="texte" id="count" > <?=mt_rand(60,218)?> Tempo</div>
<div class="texte" id="mois" > em abril. </div>

<img src="http://creation.funizi.com/images-theme-perso/1508674435.png" id="eye"> 
 

        </div>
        
        </body>
        </html>
      