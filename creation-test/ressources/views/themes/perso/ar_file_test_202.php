
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">
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
#backgroun{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
.photo{ position:absolute;z-index:2;overflow: hidden; height:420px; width:266px; filter: grayscale(100%); }
.photo img{left:-50Px; opacity: 0.5;}
.img_profile{width:420Px;}
#fb_id_friend_1{position: absolute; z-index:2; left: 58px; top: 115px; width:140px ; padding:6px; background:#FFF; border:4px solid #000; border-radius:100px; max-width:800px; max-height:420px;}
#name_friend_1{position:absolute; z-index:2; left: 0px; top:290px; font-size:30px; color:#FFF; width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 
#name_friend_1role{position:absolute; z-index:2; left: 0px; top:50px; font-size:30px; color:#FFF; width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 
#fb_id_friend_2{position: absolute; z-index:2; left: 324px; top: 115px; width:140px ; padding:6px; background:#FFF; border:4px solid #000; border-radius:100px; max-width:800px; max-height:420px;}
#name_friend_2{position:absolute; z-index:2; left: 266px; top: 290px; font-size:30px; color:#FFF;  width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 
#name_friend_2role{position:absolute; z-index:2; left: 266px; top: 50px; font-size:30px; color:#FFF;  width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 
#fb_id_friend_3{position: absolute; z-index:2; left: 591px; top: 115px; width:140px ;  padding:6px; background:#FFF; border:4px solid #000;border-radius:100px; max-width:800px; max-height:420px;}
#name_friend_3{position:absolute; z-index:2; left: 532px; top: 290px; font-size:30px; color:#FFF; width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 
#name_friend_3role{position:absolute; z-index:2; left: 532px; top: 50px; font-size:30px; color:#FFF; width:266px; text-align:center; line-height:40px;font-family: 'Passion One', cursive;} 

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
      
<img src="http://creation.funizi.com/images-theme-perso/1510096007.jpg" id="backgroun"> 
<div class='photo' style="top:0;left:0">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=420&height=420" class="img_profile" id="fb_id_user">
</div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="name texte" id="name_friend_1role" >الملاك الحارس</div>
<div class="name texte" id="name_friend_1" ><?php echo $_GET['friend_first_name_1']; ?></div>
<div class='photo' style="top:0;left:267px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=420&height=420" class="img_profile" id="fb_id_user" >
</div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_2">
<div class="name texte" id="name_friend_2role" >معلم معروف</div>
<div class="name texte" id="name_friend_2" ><?php echo $_GET['friend_first_name_2']; ?></div>
<div class='photo' style="top:0;left:532px;width:268px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=420&height=420" class="img_profile" id="fb_id_user">
</div><
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_3">
<div class="name texte" id="name_friend_3role" >مكافحة الإجهاد</div>
<div class="name texte" id="name_friend_3" ><?php echo $_GET['friend_first_name_3']; ?></div>

        </div>
        
        </body>
        </html>
      