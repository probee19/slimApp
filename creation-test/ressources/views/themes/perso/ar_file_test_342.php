
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme|Shrikhand" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: -50px; top: 0px;  width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%;font-family: 'Acme', sans-serif;  max-width:800px; max-height:420px;}

#overlay_img{position:absolute; z-index:1; right:-180px; top:0; -webkit-mask-image: linear-gradient(to right, transparent 8%, black 18%);mask-image: linear-gradient(to right, transparent 8%, black 18%); max-width:800px; max-height:420px; }
#texte{z-index:1; font-family: 'Acme', sans-serif; position: absolute; right: 20px; top: 50px; color:#000; font-size:45px; line-height:50px; width:450px ; height:180px ; display:flex; align-items:center; justify-content:center;   text-align:center; }
#lettre{z-index:1; font-family: 'Shrikhand', cursive; position: absolute; right: 20px; bottom: 60px; color:#000; font-size:125px; line-height:125px; width:450px ; height:100px ; display:flex; align-items:center; justify-content:center;   text-align:center;text-shadow: 4px 0 0 #fff, -4px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff; }
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
          $lettres = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','V','Y');
          shuffle($lettres);
?>
<!DOCTYPE HTML>

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/1525353250.png" id="overlay_img"> 

<div class="texte" id="texte"> L'initiale de ton/ta vrai(e) ami(e) est ...</div>
<div class="texte" id="lettre"><?=$lettres[0]?></div>

 

        </div>
        
        </body>
        </html>
      