
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; background: #000; }
#titre_test{position:absolute; z-index:1; left:0; top:0;  width:800px; background:#000; text-align:center; font-size:2em; color:#fff; padding-top:15px;padding-bottom:15px;font-weight:bold; }
#fb_id_user{position: absolute; z-index:1; left: 50px; top: 80px; width:280px ; max-width:800px; max-height:420px;;}
#name_user{position:absolute; z-index:1; left: 0px; top: 380px; font-size:30px; color:#FFF; text-align:center; width:380px;}
#name_user span{padding:5px; background:#000 ; color:#FFF;border-radius:10px; font-size:0.7em;}
#resultat{position:absolute; z-index:1; left: 380px; top: 180px; font-size:80px; color:#000; font-weight:bold; width:400px; height:200px;line-height:45px; text-align:center;}

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
      
<div id='titre_test'><?php echo $_GET['user_name']; ?> Sie werden gehasst von:</div>
<img src='<?php echo $_GET['url_img_profile_user']; ?>'class='img_profile' id='fb_id_user'>
<div id='resultat' ><?php echo rand (50,499);?> <div style="font-size:25px;">Menschen</div>
</div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      