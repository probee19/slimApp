
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam|Merienda+One|Pacifico" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFC300;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#top{z-index:1;font-family: 'Kalam', cursive; position: absolute; left: 0px; top: 0px; color:#FFF; font-size:40px; width:800px ; background:#1E0402; padding:5px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 130px; width:200px ; border-radius:200px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#texte{z-index:1; font-family: 'Merienda One', cursive; position: absolute; left: 320px; top: 140px; color:#000; font-size:35px; line-height:43px; width:450px ; height:300px ; padding:5px; text-align:center; max-width:800px; max-height:420px;}
 
#score{z-index:2; font-family: 'Pacifico', cursive; position: absolute; left: 200px; top: 180px; color:#DC1504; font-size:100px;line-height: 90px;  width:120px ; height:120px ;  background:#FFF; border:3px solid #1E0402; border-radius:120px;  text-align:center; max-width:800px; max-height:420px;}
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
$texte = array('Tu es une personne d&#39;une parfaite beauté, je peux mettre n&#39;importe quel dans la poche','Wouaw! Avec cette beauté magnifique que tu as, tout le monde te cherche!','Sur ne parle que de toi! Tu comme une beauté extraordinaire!');
$score = array('11','12','10');
$k = mt_rand(0,2);
?>
<div class="texte" id="top"> <?php echo $_GET['user_name']; ?> VOICI TON SCORE! </div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="texte" id="texte"><?php echo $texte[$k]; ?></div>
<div class="texte" id="score"><span></span><?php echo $score[$k]; ?></span></div>



        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      