
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
.photo{ position:absolute;overflow: hidden; height:210px; width:100px; background:#000; }
.photo img{left:-55Px;}
.img_profile{width:210Px;}

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
      
<div class='photo' style="top:0;left:0">
 <img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:100px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:200px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:300px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:400px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:500px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_5']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:600px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_6']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:0;left:700px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_7']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:0">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_8']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:100px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_9']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:200px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_10']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:300px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_11']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:400px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_12']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:500px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_13']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='photo' style="top:210px;left:600px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_14']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>


        </div>
        
        </body>
        </html>
      