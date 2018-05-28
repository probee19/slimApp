
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:2; left: 40px; top: 85px; width:250px ; border:1px solid #000; border-radius:30px; max-width:800px; max-height:420px;}

#background{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; }

.reve{position:absolute; font-family: 'Josefin Sans', sans-serif; z-index:2; right:40px; width:410px; background:#FFF; border-radius:10px; font-size:30px; line-height:30px; height:75px;display:flex; align-items:center; justify-content:left; padding-left:20px; color:#283593; }
#reve1{top:85px;}
#reve2{top:175px;}
#reve3{top:260px;}
.points{position:absolute; z-index:3; left:310px; width:30px; height:30px; border-radius:30px; background:#FFF; text-align:center;
         -webkit-box-shadow: 0px 0px 18px 8px rgba(232,232,232,1);
-moz-box-shadow: 0px 0px 18px 8px rgba(232,232,232,1);
box-shadow: 0px 0px 18px 8px rgba(232,232,232,1);
}
#point1{top:110px;}
#point2{top:200px;}
#point3{top:285px;}
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
<?php
          $reves = array('You will have a new car','You will move into a new villa','You will become rich','You will win a national prize',
          'You will have a salary increase','You will marry a rich celebrity','You will have a new child');
          shuffle($reves);
?>
<img src="http://creation.funizi.com/images-theme-perso/1514369932.jpg" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">

<div class="reve" id="reve1"><?php echo $reves[0]; ?></div>
<div class="reve" id="reve2"><?php echo $reves[1]; ?></div>
<div class="reve" id="reve3"><?php echo $reves[2]; ?></div>
<div class="points" id="point1"></div>
<div class="points" id="point2"></div>
<div class="points" id="point3"></div>


        </div>
        
        </body>
        </html>
      