
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 12px; top: 5px; width:70px ; border-radius:70px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 100px; top: 300px; font-size:30px; color:#FFF;} 

#fb_id_friend_1{position: absolute; z-index:1;  border:1px solid; left: 20px; top: 85px;  width:60px ; border-radius:60px; max-width:800px; max-height:420px;}
#name_friend_1{position:absolute; z-index:1; left: 170px; top: 110px; font-size:30px; color:#000;} 
#fb_id_friend_2{position: absolute; z-index:1;  border:1px solid; left: 20px; top: 150px;  width:60px ; border-radius:60px; max-width:800px; max-height:420px;}
#name_friend_2{position:absolute; z-index:1; left: 170px; top: 175px; font-size:30px; color:#000;} 
#fb_id_friend_3{position: absolute; z-index:1;  border:1px solid; left: 20px; top: 220px;  width:60px ; border-radius:60px; max-width:800px; max-height:420px;}
#name_friend_3{position:absolute; z-index:1; left: 170px; top: 240px; font-size:30px; color:#000;} 
#fb_id_friend_4{position: absolute; z-index:1;  border:1px solid; left: 20px; top: 287px;  width:60px ; border-radius:60px; max-width:800px; max-height:420px;}
#name_friend_4{position:absolute; z-index:1; left: 170px; top: 310px; font-size:30px; color:#000;} 
#fb_id_friend_5{position: absolute; z-index:1;  border:1px solid; left: 20px; top: 357px;  width:60px ; border-radius:60px; max-width:800px; max-height:420px;}
#name_friend_5{position:absolute; z-index:1; left: 170px; top: 380px; font-size:30px; color:#000;} 
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
      
<img src="http://creation.funizi.com/images-theme-perso/1508703005.jpg" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="name texte" id="name_friend_1" ><?php echo urldecode($_GET['friend_name_1']); ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_2">
<div class="name texte" id="name_friend_2" ><?php echo urldecode($_GET['friend_name_2']); ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_3">
<div class="name texte" id="name_friend_3" ><?php echo urldecode($_GET['friend_name_3']); ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_4">
<div class="name texte" id="name_friend_4" ><?php echo urldecode($_GET['friend_name_4']); ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_5']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_5">
<div class="name texte" id="name_friend_5" ><?php echo urldecode($_GET['friend_name_5']); ?></div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      