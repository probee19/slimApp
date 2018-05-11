
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Courgette|Signika" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #581845;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#texte_top{z-index:2; font-family: 'Signika', sans-serif; position: absolute; left: 0px; top: 0px; color:#FFF; font-size:50px; line-height:50px; width:800px ; background:#837E7D; padding:5px; text-align:center;}
#fb_id_friend_1{position: absolute; z-index:1; border:1px solid; left: 50px; top: 120px; width:230px ; border-radius:250px; max-width:800px; max-height:420px;}
#chapeau{position:absolute; z-index:1; left:53px; top:30px; width:270px; max-width:800px; max-height:420px; } 
#fb_id_user{position: absolute; z-index:1; border:1px solid; right: 125px; top: 130px; width:180px ; border-radius:180px; }
#loope{position:absolute; z-index:1; width:300px; right:10px; webkit-transform:scaleX(-1); transform:scaleX(-1);  top:120px;  max-width:800px; max-height:420px; }
#paragraphe{z-index:1; font-family: 'Courgette', cursive;position: absolute; bottom: 35px; left: 20px; color:#FFF; font-size:28px; width:780px ; background:transparent; text-align:left; max-width:800px; max-height:420px;}
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
      
<div class="texte" id="texte_top">من الذي يتبعني سرا؟ </div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<img src="http://creation.funizi.com/images-theme-perso/1508948989.png" id="chapeau"> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<img src="http://creation.funizi.com/images-theme-perso/1508931375.png" id="loope"> 
<div class="texte" id="paragraphe"><?php echo $_GET['user_name']; ?>, <?php echo $_GET['friend_first_name_1']; ?> اتبع لك في السر! </div>


        </div>
        
        </body>
        </html>
      