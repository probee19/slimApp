
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme|Boogaloo" rel="stylesheet">
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
.name{color:#0D10D8;}
 
#eye{position:absolute; z-index:1; right:220px; top:80px;  max-width:800px; max-height:420px; }
#titre_top{z-index:1; position: absolute;font-family: 'Acme', sans-serif; left: 0px; top: 0px; color:#FFF; font-size:40px; width:800px ; height:auto ; background:#FF5733; padding:5px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_friend_1{position: absolute; z-index:1; left: 70px; top: 130px; width:200px ; border:4px solid #D81C0D; border-radius:200px; max-width:800px; max-height:420px;}

#phrase{z-index:1; font-family: 'Boogaloo', cursive; position: absolute; right: 0px; top: 130px; color:#FF3F33; font-size:50px; line-height:55px; width:450px ; height:300px ; background:transparent; border:0; border-radius:0px;  padding:15px; text-align:center; max-width:800px; max-height:420px;}
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
      
<div class="texte" id="titre_top">¿Quién miró tus álbumes de fotos de Facebook? </div>
<img src="http://creation.funizi.com/images-theme-perso/1508674435.png" id="eye"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="texte" id="phrase"> <span class="name"><?php echo $_GET['friend_first_name_1']; ?></span> miró las fotos de <span class="name"><?php echo $_GET['user_name']; ?></span> <?php echo mt_rand(20,37);  ?>hoy </div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      