
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 37px; top: 10px; width:380px ; opacity:0.6; border-radius:380px; max-width:800px; max-height:420px;}
#texte{position:absolute; font-family: 'Dancing Script', cursive; z-index:1; right: 30px; top: 10px; width:350px;  height:300px ;font-size:50px; line-height:55px; color:#FFF; display:flex; justify-content:center; align-items:center; text-align:center} 

#name{position:absolute; font-family: 'Dancing Script', cursive; z-index:1; right: 50px; bottom: 107px; font-size:40px;  color:#FFF;  text-align:right} 
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

<img src="http://creation.funizi.com/images-theme-perso/1513858951.jpg" id="background"> 

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div id="texte" >Je te souhaite à toi et à ta famille un très joyeux Noël. </div>
<div id="name" ><?php echo urldecode($_GET['user_name']); ?> </.div>

        </div>
        
        </body>
        </html>
      