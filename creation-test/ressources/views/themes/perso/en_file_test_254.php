
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Cookie|Satisfy" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFAB00;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 320px; bottom: 0; width:160px ;}
#mot{position: absolute; z-index:1; left: 100px; top: 160px; width:600px ;
font-family: 'Cookie', cursive; text-align:center; font-size:75px; }

.friendOne{position: absolute; z-index:1; top: 0; width:160px ;}
.friendTwo{position: absolute; z-index:1; bottom: 0; width:160px ;}
#fb_id_friend_1{left: 0;}
#fb_id_friend_2{left: 160px;}
#fb_id_friend_3{left: 320px;}
#fb_id_friend_4{left: 480px;}
#fb_id_friend_5{left: 640px;}
#fb_id_friend_6{left: 0;}
#fb_id_friend_7{left: 160px;}
#fb_id_friend_8{left: 480px;}
#fb_id_friend_9{left: 640px;}


#heart{position:absolute; z-index:1; left:20px; bottom:170px; width:100px;  max-width:800px; max-height:420px; }
#heart2{position:absolute; z-index:1; right:20px; bottom:170px; width:100px;  max-width:800px; max-height:420px;-webkit-transform: scaleX(-1);
    transform: scaleX(-1); }

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
<?php 
          $mots = array('Prosperity', 'Excellency', 'Success', 'Success', 'Perseverance', 'Production', 'Happiness', 'Adventure');  
          shuffle($mots);
?>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile friendOne" id="fb_id_friend_1">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile friendOne" id="fb_id_friend_2">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile friendOne" id="fb_id_friend_3">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile friendOne" id="fb_id_friend_4">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_5']; ?>/picture/?width=275&height=275" class="img_profile friendOne" id="fb_id_friend_5">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_6']; ?>/picture/?width=275&height=275" class="img_profile friendTwo" id="fb_id_friend_6">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_7']; ?>/picture/?width=275&height=275" class="img_profile friendTwo" id="fb_id_friend_7">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_8']; ?>/picture/?width=275&height=275" class="img_profile friendTwo" id="fb_id_friend_8">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_9']; ?>/picture/?width=275&height=275" class="img_profile friendTwo" id="fb_id_friend_9">

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div id="mot" ><?php echo $mots[0]; ?></div>


<img src="http://creation.funizi.com/images-theme-perso/1514378595.png" id="heart">
<img src="http://creation.funizi.com/images-theme-perso/1514378595.png" id="heart2">  



        </div>
        
        </body>
        </html>
      