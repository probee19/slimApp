
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">

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
#fb_id_user{position: absolute; z-index:1; left: 50px; top: 100px; width:200px ;border:4px dotted #FF4F00; border-radius:0px; max-width:800px; max-height:420px;}
#message{position:absolute; z-index:2; right:10px; top:10px; padding:20px;border:4px dotted #FF4F00; width:469px; height:380px; font-size:40px; line-height:50px;font-family: 'Bree Serif', serif; text-align:center;color:#FFF;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
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
$message = array('&quot;Ich bereue meine Vergangenheit nicht, ich bereue nur die verlorene Zeit mit den falschen Leuten.&quot;','&quot;Was immer wir tun, wir werden immer kritisiert werden, also tu so viel, wie wir wollen!&quot;','&quot;Ich bin nicht herzlos, ich habe es nur mit Leuten gelernt, die es verdienen&quot;','&quot;Lass niemanden dein Leben richten, weil niemand die gleichen Dinge gelebt hat wie du!&quot;','&quot;Es ist besser, von wenigen Menschen umgeben zu sein, die dich lieben, als von vielen Menschen, die dich dazu bringen, es zu glauben.&quot;');
shuffle($message);
?>
<img src="http://creation.funizi.com/images-theme-perso/1508776234.jpg" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?><br>- <?php echo urldecode($_GET['user_name']); ?>
-</div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      