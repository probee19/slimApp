
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

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_friend_2{position: absolute; z-index:0; right: 113px; top: 14px; width:90px ;  height:136px ; transform:rotate(-0.6deg);  object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
 

#fb_id_friend_1{position: absolute; z-index:1; left: 104px; top: 16px; width:85px ;  height:134px ; transform:rotate(-1.4deg);  object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
#fb_id_user{position: absolute; z-index:1; left: 348px; top: 16px; width:85px ;  height:134px ; transform:rotate(-0.8deg);  object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}

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

<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
 
<img src="https://creation.funizi.com/images-theme-perso/1525784882.png" id="back"> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<!-- https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275 -->
<!-- https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275   img_profile -->
<img src="https://creation.funizi.com/images-theme-perso/dec_1.jpg" class="" id="fb_id_friend_1">

<img src="https://creation.funizi.com/images-theme-perso/dec_2.jpg" class="" id="fb_id_friend_2">



        </div>
        
        </body>
        </html>
      