
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
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
#background{position:absolute; z-index:2; left:0; top:0;  max-width:800px; max-height:420px; }
.titre{position:absolute; top: 0; left: 0; z-index:2; font-weight:bold;  padding:10px; width:100%; background:#F77E38; text-align:center; font-size:35px; color: #fff; font-weight:bold; }
#fb_id_user{position: absolute; z-index:1;left: 34px; top: 86px; width:256px ; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 34px; top: 86px; font-size:30px; color:#FFF;}
#message{position:absolute; z-index:2; left:512px; top:86px; width:256px; height:256px; font-size:80px; line-height:70px;font-family: 'Courgette', cursive; text-align:center;color:#FFF;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
.titre_bottom{position:absolute; bottom: 0; left: 0; z-index:2; font-weight:bold;  padding:10px; width:100%; background:#F77E38; text-align:center; font-size:35px; color: #fff; font-weight:800px; }

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
$message = array('Wollüstig','schelmisch','Zucker','leidenschaftlich','Experte','Sinnlich');
shuffle($message);
?>
<img src="http://creation.funizi.com/images-theme-perso/1508852359.png" id="background">
<span id="titre" class="titre">Ihre Partner haben Ihre Küsse notiert:</span>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div id="message"> <b><?php echo mt_rand(13,20) ?></b>/10</div>
<span id="titre_bottom" class="titre_bottom">Art des Kusses: <?php echo $message[0]; ?></span>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      