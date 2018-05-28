
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700|Shrikhand" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF; color:#FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#background{position:absolute; z-index:1; left:0; top:0; width:800px; max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 50px; top: 120px; width:180px ;  max-width:800px; max-height:420px;}
#name_user{position:absolute; font-family: 'Shrikhand',cursive; z-index:1; left: 30px; top: 340px; width:210px; font-size:21px; text-align:center; color:#FFF;} 

#cadre{position:absolute; z-index:1; left:30px; top:100px;  max-width:800px; max-height:420px; }
#surprise{position:absolute; font-family: 'Shrikhand', cursive; z-index:1; right:30px; top:130px; font-size:30px;color:#FFF; 
line-height:40px; width:480px; height:220px; display:flex; justify-content:center; align-items:center; text-align:center;}
#year{position:absolute; font-family: 'Shrikhand', cursive; z-index:1; right:30px; top:90px;color:#0D47A1; font-size:70px;  width:450px; text-align:center; 
          text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
}
#img{position:absolute; z-index:2; left:170px; top:230px; max-width:800px; max-height:420px; }
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
          $surprises = array('Du wirst ein Baby haben. '.$_GET[' Benutzername'].' S Familie wird einen neuen Schatz haben!', 
                    'Schwer zu entscheiden '.$_GET[' Nutzername'].'. Viele Dinge werden sich nächstes Jahr verbessern!',
                    'Sie erhalten einen neuen perfekten Job, der Ihre Erwartungen perfekt erfüllt!',
                    'Sie werden in diesem Jahr eine professionelle Promotion haben',
                    'Sie werden eine Reise voller Erlebnisse und Entdeckungen machen!');
          shuffle($surprises);
?>
<!DOCTYPE HTML>
<img src="http://creation.funizi.com/images-theme-perso/1513949055.jpg" id="background"> 
<div id="year">2018</div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>

<img src="http://creation.funizi.com/images-theme-perso/1513948643.png" id="cadre"> 
<div id="surprise"><?php echo $surprises[0]; ?></div>
 



        </div>
        
        </body>
        </html>
      