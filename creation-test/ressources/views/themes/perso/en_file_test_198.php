
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#bottom{ position:absolute; height:120px; width:800px; bottom:0; text-align:center;background:#000; padding-top:65px; }
#mot{ color:#FFF; font-size: 70px;
    background: -webkit-linear-gradient(#0080FF, #99CCFF);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;font-family: 'Archivo Black', sans-serif;}
.photo{ position:absolute;z-index:2;overflow: hidden; height:300px; width:200px; background:#000;  filter: grayscale(100%); }
.photo img{left:-50Px;}
.img_profile{width:300Px;}
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
  if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
            $texte = array('happy','Leader','Honest','Powerful','Leader','Success');
  }
            else{ 
             $texte = array('happy','Leader','Honest','Powerful','Wise','Success');

            }
shuffle($texte);
?>
<div id="bottom"><span id="mot"><?php echo strtoupper($texte[0]); ?></span></div>
<div class='photo' style="top:0;left:0">
 <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:200px">
 <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user" style=" opacity: 0.5;">
</div>
<div class='photo' style="top:0;left:400px">
 <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:600px">
 <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user" style=" opacity: 0.5;">
</div>

        </div>
        
        </body>
        </html>
      