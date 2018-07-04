
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web|Bangers" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: -70px; top: 0px;border:1px solid #000; width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#000;}

.mask{position:absolute; z-index:1; right: 0; top: 0; width:650px; height:420px; background:#FFF; -webkit-mask-image: linear-gradient(to right, transparent 8%, black 25%);mask-image: linear-gradient(to right, transparent 8%, black 25%);}

#header{z-index:1; font-family: 'Titillium Web', sans-serif; position: absolute; right: 30px; top: 30px; color:#0D47A1; font-size:34px; font-weight:600; line-height:44px; width:440px ; height:180px ; display:flex; align-items:flex-end; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

#quality{z-index:1; font-family: 'Bangers', cursive; position: absolute; right: 0; top: 240px; color:#C2185B; letter-spacing:3px; font-size:49px; line-height:57px; width:500px ; height:70px; text-transform:uppercase; display:flex; align-items:flex-start; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

#footer{z-index:1; font-family: 'Titillium Web', sans-serif;position: absolute; right: 0; top: 320px; color:#000; font-size:20px; line-height:44px; width:500px ; height:40px ; display:flex; align-items:flex-end; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
          $qualites = array('sinceridad','la precisión','la competencia','amabilidad','Romanticismo', 'fidelidad','valentía','valor','honestidad','perseverancia','lealtad','el liderazgo');
          shuffle($qualites);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<div class="mask"></div>

<div class="texte" id="header"><?php echo $_GET['user_name']; ?>, en base a nuestro análisis profundo, la calidad que mejor te describe es:</div>

<div class="texte" id="quality"><?=$qualites[0]?></div>

<div class="texte" id="footer">( exacto para <?=mt_rand(94,99)?> % )</div


        </div>
        
        </body>
        </html>
      