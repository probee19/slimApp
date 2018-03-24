
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
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

#backg{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 70px; width:280px ; border-radius:300px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#qualite_1, #qualite_2, #qualite_3{z-index:1;font-family: 'Courgette', cursive; position: absolute;  color:#0D47A1; font-size:50px; font-weight:700; width:400px ; height:80px ; padding:5px; }
#qualite_1{left: 450px; top: 40px;}
#qualite_2{left: 450px; top: 175px;}
#qualite_3{left: 450px; top: 310px;}
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
          $qualites = array('Dein Lächeln','Deine Schönheit','Deine Loyalität','Dein Mut','Dein Charakter','Deine Intelligenz','Deine Ruhe','Deine Bescheidenheit',
          'Dein Humor','Deine Ehrlichkeit','Ihre Leidenschaft','Deine Freundlichkeit','Deine Stärke','Ihre Ausstrahlung');
          shuffle($qualites);
?>        
<!DOCTYPE HTML>
<img src="http://creation.funizi.com/images-theme-perso/1518780972.png" id="backg"> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="qualite_1"><?php echo $qualites[0]; ?></div>

<div class="texte" id="qualite_2"><?php echo $qualites[1]; ?></div>

<div class="texte" id="qualite_3"><?php echo $qualites[2]; ?></div>


        </div>
        
        </body>
        </html>
      