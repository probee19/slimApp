
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
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px;} 
.photo{ position:absolute;z-index:2;overflow: hidden; height:210px; width:200px; background:#000; }
.photo img{left:-50Px;}
.img_profile{width:300Px;}
.nom{ position:absolute;z-index:3;height:60px; width:200px; background:#006CD8; text-align:center; color:#fff;font-size:20px; font-weight:bold; padding-top:20px; }
.nomgris{ position:absolute;z-index:3;height:60px; width:200px; background:#F0F0F0;  color:#006CD8;font-size:20px; font-weight:bold; padding-top:20px;  text-align:center;}
.pourcentage{ position:absolute;z-index:3;top:100px;height:90px; width:200px; text-align:center; color:#006CD8;font-size:50px; font-weight:bold; padding-top:20px; }

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
$pourcentage1=rand(10,50); $reliquat=100-$pourcentage1;
$pourcentage2=rand(10,$reliquat);
$pourcentage3=100-$pourcentage2-$pourcentage1;


?>
<img src="http://creation.funizi.com/images-theme-perso/1509153815.jpg" id="back"> 
<div class='nom'><?php echo urldecode($_GET['friend_first_name_1']); ?></div>
<div class='pourcentage' style="left:0"><?php echo $pourcentage1;?>% </div>
<div class='photo' style="bottom:0;right:600px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='nomgris' style="left:200px"><?php echo $_GET['friend_first_name_2']; ?></div>
<div class='pourcentage' style="left:200px"><?php echo $pourcentage2;?>%</div>
<div class='photo' style="bottom:0;right:400px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='nom' style="left:400px"><?php echo $_GET['friend_first_name_3']; ?></div>
<div class='pourcentage' style="left:400px"><?php echo $pourcentage3;?>%</div>
<div class='photo' style="bottom:0;right:200px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div class='nomgris' style="left:600px"><?php echo urldecode($_GET['user_name']); ?></div>
<div class='pourcentage' style="left:600px">100%</div>
<div class='photo' style="bottom:0;right:0">
 <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
</div>

        </div>
        
        </body>
        </html>
      