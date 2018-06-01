
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
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
.titre{position:absolute;  z-index:2; top: 0; left: 0;width:100%; padding-top:10px; padding-bottom:10px; background:#E4B223; text-align:center; font-size:25px; color: #2F1106;font-family: 'Lobster', cursive; }
#fb_id_user{position: absolute; z-index:1; left: 60px; top: 100px; width:200px ; border-radius:100px; border:4px solid #E4B223; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 0px; top: 320px; font-size:30px; color:#E4B223; text-align:center; width:320px; font-weight:400px;} 
#fb_id_friend_1{position: absolute; z-index:1; right: 60px; top: 100px; width:200px ; border-radius:100px; border:4px solid #E4B223;max-width:800px; max-height:420px;}
#name_friend_1{position:absolute; z-index:2; right: 0px; top: 320px; font-size:30px; color:#E4B223; text-align:center; width:320px; font-weight:400px} 
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
      
<img src="http://creation.funizi.com/images-theme-perso/1508592637.png" id="background">
<div id="titre" class="titre">Qui est ton ami (e) parfait (e) pour aller boire?</div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="name texte" id="name_friend_1" ><?php echo substr($_GET['friend_name_1'], 0, strpos($_GET['friend_name_1'], ' ')); ?></div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      