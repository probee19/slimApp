
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
                          .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
            .main img{ position:absolute; max-height:420px; max-width:800px; }
            #background{z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
            #titre{position: absolute;z-index:2; width:800px; height:60px; background:#000000; font-size:3em; font-weight:bold; text-align:center; color:#FFFFFF; padding-top:15px; }
            #fb_id_user{position: absolute; z-index:1; left: 100px; top: 100px; width:200px ; border-radius:0px; max-width:800px; max-height:420px;}
            #barreau200_user{position:absolute;z-index:1; left:100px; top:100px;  max-width:800px; max-height:420px; }
            #name_user{position:absolute; z-index:1; left: 0px; top: 350px; font-size:30px; color:#000; width:400px; text-align:center;}
            .name {background:#000; color:#FFF; padding:10px;border-radius: 15px;font-size:0.8em;}
            #fb_id_friend_1{position: absolute; z-index:1; right: 100px; top: 100px; width:200px ; border-radius:0px; max-width:800px; max-height:420px;}
            #name_friend_1{position:absolute; z-index:1; right:0px; top: 350px; font-size:30px; color:#000; width:400px; text-align:center;}
            #barreau200_friend{position:absolute;z-index:1; right:100px; top:100px;  max-width:800px; max-height:420px; }
        
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
<div id="titre">Chi andrà in prigione con te?</div>
<img src="http://creation.funizi.com/images-theme-perso/1508433666.png" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<img src="http://creation.funizi.com/images-theme-perso/1508433933.png" id="barreau200_user">
<div class="redim" id="name_user" ><span class="name"> <?php echo $_GET['user_name']; ?></span></div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<img src="http://creation.funizi.com/images-theme-perso/1508433933.png" id="barreau200_friend">
<div class="redim" id="name_friend_1" ><span class="name"> <?php echo $_GET['friend_name_1']; ?></span></div>



        </div>
        
        </body>
        </html>
      