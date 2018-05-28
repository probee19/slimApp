
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
                          .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000000;}
            #now_name{position: absolute; width: 400px; height: 50px; left:0px; top:50px; color:#FFFFFF; text-align:center; font-size:1.8em; font-weight:bold;}
            #then_name{position: absolute; width: 400px; height: 50px; left:400px; top:50px; color:#FFFFFF; text-align:center; font-size:1.8em; font-weight:bold;}
            #fb_id_user{position: absolute; z-index:1; width:300px ; border-radius:10px; top:100px;left:50px;}
            #result_image{position: absolute; z-index:1; width:300px ; border-radius:10px; top:100px;right:50px;}
        
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
                  // JAVASCRIPT

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<!DOCTYPE HTML>

<?php
 if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
               $result_image = array('http://creation.funizi.com/images-theme-perso/1508431072.jpg','http://creation.funizi.com/images-theme-perso/1508431170.jpg','http://creation.funizi.com/images-theme-perso/1508431189.jpg','http://creation.funizi.com/images-theme-perso/1508860694.jpg');
     }
            else{ 
              $result_image = array('http://creation.funizi.com/images-theme-perso/1508860173.jpg','http://creation.funizi.com/images-theme-perso/1508860292.jpg','http://creation.funizi.com/images-theme-perso/1508860509.jpg');

            }
 
  shuffle($result_image);
?>
<div id="" style="witdh:800px; Height:420px; background:#000"></div>
<div id="agora_name"><?php echo urldecode($_GET['user_name']); ?> agora</div>
<div id="then_name"><?php echo urldecode($_GET['user_name']); ?> em 2023</div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<img src="<?php echo $result_image[0]; ?>" id="result_image">


        </div>
        
        </body>
        </html>
      